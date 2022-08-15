<?php

declare(strict_types=1);

namespace Shopify\Auth;

use Shopify\Clients\Http;
use Shopify\Clients\HttpHeaders;
use Shopify\Clients\HttpResponse;
use Shopify\Context;
use Shopify\Exception\CookieNotFoundException;
use Shopify\Exception\CookieSetException;
use Shopify\Exception\HttpRequestException;
use Shopify\Exception\InvalidArgumentException;
use Shopify\Exception\InvalidOAuthException;
use Shopify\Exception\MissingArgumentException;
use Shopify\Exception\OAuthSessionNotFoundException;
use Shopify\Exception\SessionStorageException;
use Shopify\Utils;
use Ramsey\Uuid\Uuid;

/**
 * Provides methods to perform OAuth with Shopify.
 */
class OAuth
{
    public const SESSION_ID_COOKIE_NAME = 'shopify_session_id';
    public const SESSION_ID_SIG_COOKIE_NAME = 'shopify_session_id_sig';
    public const ACCESS_TOKEN_POST_PATH = '/admin/oauth/access_token';

    /**
     * Initializes a session and cookie for the OAuth process, and returns the authorization url
     *
     * @param string        $shop              A Shopify domain name or hostname
     * @param string        $redirectPath      Redirect path for callback
     * @param bool          $isOnline          Whether or not the session is online
     * @param null|callable $setCookieFunction An optional override for setting cookie in response
     *
     * @return string The URL for OAuth redirection
     * @throws \Shopify\Exception\CookieSetException
     * @throws \Shopify\Exception\PrivateAppException
     * @throws \Shopify\Exception\SessionStorageException
     * @throws \Shopify\Exception\UninitializedContextException
     */
    public static function begin(
        string $shop,
        string $redirectPath,
        bool $isOnline,
        ?callable $setCookieFunction = null
    ): string {
        Context::throwIfUninitialized();
        Context::throwIfPrivateApp("OAuth is not allowed for private apps");

        $sanitizedShop = Utils::sanitizeShopDomain($shop);

        if (!isset($sanitizedShop)) {
            throw new InvalidArgumentException("Invalid shop domain: $shop");
        }

        $redirectPath = trim(strtolower($redirectPath));
        $redirectPath = ($redirectPath[0] == '/') ? $redirectPath : '/' . $redirectPath;

        $mySessionId = $isOnline ? Uuid::uuid4()->toString() : self::getOfflineSessionId($sanitizedShop);

        $cookieSet = self::setCookieSessionId($setCookieFunction, $mySessionId, strtotime('+1 minute'));
        if (!$cookieSet) {
            throw new CookieSetException(
                'OAuth Cookie could not be saved.'
            );
        }

        $session = new Session($mySessionId, $sanitizedShop, $isOnline, Uuid::uuid4()->toString());

        if ($isOnline) {
            $session->setExpires(strtotime('+1 minute'));
            $grantOptions = 'per-user';
        } else {
            $grantOptions = '';
        }

        $sessionStored = Context::$SESSION_STORAGE->storeSession($session);

        if (!$sessionStored) {
            throw new SessionStorageException(
                'OAuth Session could not be saved. Please check your session storage functionality.'
            );
        }

        $query = [
            'client_id' => Context::$API_KEY,
            'scope' => Context::$SCOPES->toString(),
            'redirect_uri' => Context::$HOST_SCHEME . '://' . Context::$HOST_NAME . $redirectPath,
            'state' => $session->getState(),
            'grant_options[]' => $grantOptions,
        ];

        return "https://{$sanitizedShop}/admin/oauth/authorize?" . http_build_query($query);
    }

    /**
     * Performs the OAuth callback steps, checking the returned parameters and fetching the access token, preparing the
     * session for further usage. If successful, the updated session is returned.
     *
     * @param array         $cookies           HTTP request cookies, from which the OAuth session will be loaded. This
     *                                         must be a hash of cookie name => value pairs. Value will be forcibly cast
     *                                         to string so objects that implement toString will also work.
     * @param array         $query             The HTTP request URL query values.
     * @param null|callable $setCookieFunction An optional override for setting cookie in response.
     *
     * @return Session
     * @throws \Shopify\Exception\HttpRequestException
     * @throws \Shopify\Exception\InvalidOAuthException
     * @throws \Shopify\Exception\OAuthCookieNotFoundException
     * @throws \Shopify\Exception\OAuthSessionNotFoundException
     * @throws \Shopify\Exception\PrivateAppException
     * @throws \Shopify\Exception\SessionStorageException
     * @throws \Shopify\Exception\UninitializedContextException
     */
    public static function callback(array $cookies, array $query, ?callable $setCookieFunction = null): Session
    {
        Context::throwIfUninitialized();
        Context::throwIfPrivateApp('OAuth is not allowed for private apps');

        $cookieSessionId = self::getCookieSessionId($cookies);
        $session = Context::$SESSION_STORAGE->loadSession($cookieSessionId);
        if (!$session) {
            throw new OAuthSessionNotFoundException(
                'You may have taken more than 60 seconds to complete the OAuth process and the session cannot be found'
            );
        }

        if (!self::isCallbackQueryValid($query, $session)) {
            throw new InvalidOAuthException('Invalid OAuth callback.');
        }

        $response = self::fetchAccessToken($query, $session);

        $session->setAccessToken($response->getAccessToken());
        $session->setScope($response->getScope());

        if ($session->isOnline()) {
            /** @var AccessTokenOnlineResponse $response */
            $session->setExpires(time() + $response->getExpiresIn());
            $session->setOnlineAccessInfo($response->getAssociatedUser());

            // If this is an online session in an embedded app, we replace it with a session that can be loaded from a
            // JWT.
            if (Context::$IS_EMBEDDED_APP) {
                $jwtSessionId = self::getJwtSessionId($session->getShop(), $session->getOnlineAccessInfo()->getId());
                $jwtSession = $session->clone($jwtSessionId);

                $sessionDeleted = Context::$SESSION_STORAGE->deleteSession($session->getId());
                if (!$sessionDeleted) {
                    throw new SessionStorageException(
                        'OAuth Session could not be deleted. Please check your session storage functionality.',
                    );
                }
                $session = $jwtSession;
            }
        }

        $sessionStored = Context::$SESSION_STORAGE->storeSession($session);
        if (!$sessionStored) {
            throw new SessionStorageException(
                'OAuth Session could not be saved. Please check your session storage functionality.',
            );
        }

        $sessionExpiration = ($session->getExpires() ? (int)$session->getExpires()->format('U') : null);
        $cookieSet = self::setCookieSessionId(
            $setCookieFunction,
            $cookieSessionId,
            Context::$IS_EMBEDDED_APP ? time() : $sessionExpiration
        );
        if (!$cookieSet) {
            throw new CookieSetException(
                'OAuth Cookie could not be saved.'
            );
        }

        return $session;
    }

    /**
     * Builds a session id that can be loaded from JWTs from App Bridge
     *
     * @param string     $shop   The session's shop
     * @param string|int $userId |int The session's user
     *
     * @return string
     */
    public static function getJwtSessionId(string $shop, $userId): string
    {
        return "{$shop}_{$userId}";
    }

    /**
     * Retrieves the offline session ID tied to a single shop
     *
     * @param string $shop  The session's shop
     * @return string the offline session ID
     */
    public static function getOfflineSessionId(string $shop): string
    {
        return "offline_{$shop}";
    }

    /**
     * Extracts the current session ID from the headers
     *
     * @param array  $rawHeaders  HTTP headers returned from the request context
     * @param array  $cookies  HTTP request cookies
     * @param bool   $isOnline Whether to load online or offline sessions
     *
     * @return string The ID of the current session
     * @throws \Shopify\Exception\MissingArgumentException
     * @throws \Shopify\Exception\CookieNotFoundException
     */
    public static function getCurrentSessionId(array $rawHeaders, array $cookies, bool $isOnline): string
    {
        if (Context::$IS_EMBEDDED_APP) {
            if ($rawHeaders) {
                $headers = new HttpHeaders($rawHeaders);

                if (!$headers->has('authorization')) {
                    throw new MissingArgumentException('Missing Authorization key in headers array');
                }
                $auth = $headers->get('authorization');
                preg_match('/^Bearer (.+)$/', $auth, $matches);
                if (!$matches) {
                    throw new MissingArgumentException('Missing Bearer token in authorization header');
                }

                $jwtPayload = Utils::decodeSessionToken($matches[1]);
                $shop = preg_replace('/^https:\/\//', '', $jwtPayload['dest']);
                if ($isOnline) {
                    $currentSessionId = self::getJwtSessionId($shop, $jwtPayload['sub']);
                } else {
                    $currentSessionId = self::getOfflineSessionId($shop);
                }
            } else {
                throw new MissingArgumentException('Missing headers argument for embedded app');
            }
        } else {
            if (!$cookies) {
                throw new CookieNotFoundException('Could not find the current session id in the cookies');
            }
            $currentSessionId = self::getCookieSessionId($cookies);
        }

        return $currentSessionId;
    }

    /**
     * Fetches the current session ID from the given cookies.
     *
     * @param array $cookies The $cookies param from `callback`
     *
     * @return string The ID of the current session
     * @throws \Shopify\Exception\CookieNotFoundException
     */
    private static function getCookieSessionId(array $cookies): string
    {
        $signature = $cookies[self::SESSION_ID_SIG_COOKIE_NAME] ?? null;
        $cookieId = $cookies[self::SESSION_ID_COOKIE_NAME] ?? null;

        $sessionId = null;
        if ($signature && $cookieId) {
            $expectedSignature = hash_hmac('sha256', $cookieId, Context::$API_SECRET_KEY);

            if ($signature === $expectedSignature) {
                $sessionId = $cookieId;
            }
        }

        if (!$sessionId) {
            throw new CookieNotFoundException("Could not find the current session id in the cookies");
        }

        return (string)$sessionId;
    }

    /**
     * Sets the session ID in the right cookie.
     *
     * @param null|callable $setCookieFunction An optional override for setting cookie in response
     * @param string        $sessionId         The ID of the session to save
     * @param int           $expiration        Epoch timestamp (in s) when the cookie expires
     *
     * @return bool Whether the cookie was successfully set
     */
    private static function setCookieSessionId(?callable $setCookieFunction, $sessionId, $expiration): bool
    {
        $signature = hash_hmac('sha256', $sessionId, Context::$API_SECRET_KEY);
        $signatureCookie = new OAuthCookie($signature, self::SESSION_ID_SIG_COOKIE_NAME, $expiration, true, true);
        $cookie = new OAuthCookie($sessionId, self::SESSION_ID_COOKIE_NAME, $expiration, true, true);

        if ($setCookieFunction) {
            $cookieSet = $setCookieFunction($signatureCookie);
            $cookieSet = $cookieSet && $setCookieFunction($cookie);
        } else {
            // @codeCoverageIgnoreStart
            // cannot mock setcookie() function
            $cookieSet = setcookie(
                $signatureCookie->getName(),
                $signatureCookie->getValue(),
                $signatureCookie->getExpire(),
                "",
                "",
                $signatureCookie->isSecure(),
                $signatureCookie->isHttpOnly(),
            );

            $cookieSet = $cookieSet && setcookie(
                $cookie->getName(),
                $cookie->getValue(),
                $cookie->getExpire(),
                "",
                "",
                $cookie->isSecure(),
                $cookie->isHttpOnly(),
            );
            // @codeCoverageIgnoreEnd
        }

        return $cookieSet;
    }

    /**
     * Checks whether the given query parameters are from a valid callback request.
     *
     * @param array   $query   The URL query parameters
     * @param Session $session The current session
     *
     * @return bool
     * @throws \Shopify\Exception\UninitializedContextException
     */
    private static function isCallbackQueryValid(array $query, Session $session): bool
    {
        $sanitizedShop = Utils::sanitizeShopDomain($query['shop'] ?? '');
        $state = $query['state'] ?? '';
        $code = $query['code'] ?? '';

        return (
            ($code) &&
            ($sanitizedShop && strcmp($session->getShop(), $sanitizedShop) === 0) &&
            ($state && strcmp($session->getState(), $state) === 0) &&
            Utils::validateHmac($query, Context::$API_SECRET_KEY)
        );
    }

    /**
     * Fetches the access token for the given OAuth session, using the query parameters returned by Shopify
     *
     * @param array   $query   The URL query params from the OAuth callback
     * @param Session $session The OAuth session
     *
     * @return AccessTokenResponse|AccessTokenOnlineResponse The access token exchanged for the OAuth code
     * @throws \Shopify\Exception\HttpRequestException
     */
    private static function fetchAccessToken(
        array $query,
        Session $session
    ) {
        $post = [
            'client_id' => Context::$API_KEY,
            'client_secret' => Context::$API_SECRET_KEY,
            'code' => $query['code'],
        ];

        $client = new Http($session->getShop());
        $response = self::requestAccessToken($client, $post);
        if ($response->getStatusCode() !== 200) {
            throw new HttpRequestException("Failed to get access token: {$response->getDecodedBody()}");
        }

        if ($session->isOnline()) {
            return self::buildAccessTokenOnlineResponse($response->getDecodedBody());
        } else {
            return self::buildAccessTokenResponse($response->getDecodedBody());
        }
    }

    /**
     * Builds an online access token response object
     *
     * @param array $body The HTTP response body
     */
    private static function buildAccessTokenOnlineResponse(array $body): AccessTokenOnlineResponse
    {
        $associatedUser = new AccessTokenOnlineUserInfo(
            $body['associated_user']['id'],
            $body['associated_user']['first_name'],
            $body['associated_user']['last_name'],
            $body['associated_user']['email'],
            $body['associated_user']['email_verified'],
            $body['associated_user']['account_owner'],
            $body['associated_user']['locale'],
            $body['associated_user']['collaborator'],
        );

        return new AccessTokenOnlineResponse(
            $body['access_token'],
            $body['scope'],
            $body['expires_in'],
            $body['associated_user_scope'],
            $associatedUser,
        );
    }

    /**
     * Builds an offline access token response object
     *
     * @param array $body The HTTP response body
     */
    private static function buildAccessTokenResponse(array $body): AccessTokenResponse
    {
        return new AccessTokenResponse($body['access_token'], $body['scope']);
    }

    /**
     * Fires the actual request for the access token. This was isolated so it can be stubbed in unit tests.
     *
     * @param Http  $client
     * @param array $post The POST payload
     *
     * @return \Shopify\Clients\HttpResponse
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws \Shopify\Exception\UninitializedContextException
     * @codeCoverageIgnore
     */
    public static function requestAccessToken(Http $client, array $post): HttpResponse
    {
        return $client->post(self::ACCESS_TOKEN_POST_PATH, $post);
    }
}
