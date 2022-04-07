<?php

declare(strict_types=1);

namespace Shopify\Rest;

use Shopify\Auth\Session;
use Shopify\Clients\Rest;
use Shopify\Clients\RestResponse;
use Doctrine\Inflector\InflectorFactory;
use ReflectionClass;
use Shopify\Context;
use Shopify\Exception\RestResourceException;
use Shopify\Exception\RestResourceRequestException;

abstract class Base
{
    public static string $API_VERSION;
    public static ?array $NEXT_PAGE_QUERY = null;
    public static ?array $PREV_PAGE_QUERY = null;

    /** @var Base[] */
    protected static array $HAS_ONE = [];

    /** @var Base[] */
    protected static array $HAS_MANY = [];

    /** @var array[] */
    protected static array $PATHS = [];

    protected static string $PRIMARY_KEY = "id";
    protected static ?string $CUSTOM_PREFIX = null;

    /** @var string[] */
    protected static array $READ_ONLY_ATTRIBUTES = [];

    private array $originalState;
    private array $setProps;
    protected Session $session;

    public function __construct(Session $session, array $fromData = null)
    {
        if (Context::$API_VERSION !== static::$API_VERSION) {
            $contextVersion = Context::$API_VERSION;
            $thisVersion = static::$API_VERSION;
            throw new RestResourceException(
                "Current Context::\$API_VERSION '$contextVersion' does not match resource version '$thisVersion'",
            );
        }

        $this->originalState = [];
        $this->setProps = [];
        $this->session = $session;

        if (!empty($fromData)) {
            self::setInstanceData($this, $fromData);
        }
    }

    public function save($updateObject = false): void
    {
        $data = self::dataDiff($this->toArray(), $this->originalState);

        $method = !empty($data[static::$PRIMARY_KEY]) ? "put" : "post";

        $saveBody = [static::getJsonBodyName() => $data];
        $response = self::request($method, $method, $this->session, [], [], $saveBody, $this);

        if ($updateObject) {
            $body = $response->getDecodedBody();

            self::createInstance($body[$this->getJsonBodyName()], $this->session, $this);
        }
    }

    public function saveAndUpdate(): void
    {
        $this->save(true);
    }

    public function __get(string $name)
    {
        return array_key_exists($name, $this->setProps) ? $this->setProps[$name] : null;
    }

    public function __set(string $name, $value): void
    {
        $this->setProperty($name, $value);
    }

    public static function getNextPageInfo()
    {
        return static::$NEXT_PAGE_QUERY;
    }

    public static function getPreviousPageInfo()
    {
        return static::$PREV_PAGE_QUERY;
    }

    public function toArray(): array
    {
        $data = [];

        foreach ($this->getProperties() as $prop) {
            if (in_array($prop, static::$READ_ONLY_ATTRIBUTES)) {
                continue;
            }

            $includeProp = !empty($this->$prop) || array_key_exists($prop, $this->setProps);
            if (self::isHasManyAttribute($prop)) {
                if ($includeProp) {
                    $data[$prop] = [];
                    /** @var self $assoc */
                    foreach ($this->$prop as $assoc) {
                        if (empty($assoc) || is_array($assoc)) {
                            array_push($data[$prop], $assoc);
                        } else {
                            array_push($data[$prop], $assoc->toArray());
                        }
                    }
                }
            } elseif (self::isHasOneAttribute($prop)) {
                if ($includeProp) {
                    if (empty($this->$prop) || is_array($this->$prop)) {
                        $data[$prop] = $this->$prop;
                    } else {
                        $data[$prop] = $this->$prop->toArray();
                    }
                }
            } elseif ($includeProp) {
                $data[$prop] = $this->$prop;
            }
        }

        return $data;
    }

    protected static function getJsonBodyName(): string
    {
        $className = preg_replace("/^([A-z_0-9]+\\\)*([A-z_]+)/", "$2", static::class);
        return strtolower(preg_replace("/([a-z])([A-Z])/", "$1_$2", $className));
    }

    /**
     * @param string[]|int[] $ids
     *
     * @return static[]
     */
    protected static function baseFind(Session $session, array $ids = [], array $params = []): array
    {
        $response = self::request("get", "get", $session, $ids, $params);

        static::$NEXT_PAGE_QUERY = static::$PREV_PAGE_QUERY = null;
        $pageInfo = $response->getPageInfo();
        if ($pageInfo) {
            static::$NEXT_PAGE_QUERY = $pageInfo->hasNextPage() ? $pageInfo->getNextPageQuery() : null;
            static::$PREV_PAGE_QUERY = $pageInfo->hasPreviousPage() ? $pageInfo->getPreviousPageQuery() : null;
        }

        return static::createInstancesFromResponse($response, $session);
    }

    /**
     * @param static $entity
     */
    protected static function request(
        string $httpMethod,
        string $operation,
        Session $session,
        array $ids = [],
        array $params = [],
        array $body = [],
        self $entity = null
    ): RestResponse {
        $path = static::getPath($httpMethod, $operation, $ids, $entity);

        $client = new Rest($session->getShop(), $session->getAccessToken());

        $params = array_filter($params);
        switch ($httpMethod) {
            case "get":
                $response = $client->get($path, [], $params);
                break;
            case "post":
                $response = $client->post($path, $body, [], $params);
                break;
            case "put":
                $response = $client->put($path, $body, [], $params);
                break;
            case "delete":
                $response = $client->delete($path, [], $params);
                break;
        }

        $statusCode = $response->getStatusCode();
        if ($statusCode < 200 || $statusCode >= 300) {
            $message = "REST request failed";

            $body = $response->getDecodedBody();
            if (!empty($body["errors"])) {
                $bodyErrors = json_encode($body["errors"]);
                $message .= ": {$bodyErrors}";
            }

            throw new RestResourceRequestException($message, $statusCode);
        }

        return $response;
    }

    /**
     * @param string[]|int[] $ids
     */
    private static function getPath(
        string $httpMethod,
        string $operation,
        array $ids,
        self $entity = null
    ): ?string {
        $match = null;

        $maxIds = -1;
        foreach (static::$PATHS as $path) {
            if ($httpMethod !== $path["http_method"] || $operation !== $path["operation"]) {
                continue;
            }

            $urlIds = $ids;
            foreach ($path["ids"] as $id) {
                if ((!array_key_exists($id, $ids) || $ids[$id] === null) && $entity && $entity->$id) {
                    $urlIds[$id] = $entity->$id;
                }
            }
            $urlIds = array_filter($urlIds);

            if (!empty(array_diff($path["ids"], array_keys($urlIds))) || count($path["ids"]) <= $maxIds) {
                continue;
            }

            $maxIds = count($path["ids"]);
            $match = preg_replace_callback(
                '/(<([^>]+)>)/',
                function ($matches) use ($urlIds) {
                    return $urlIds[$matches[2]];
                },
                $path["path"]
            );
        }

        if (empty($match)) {
            throw new RestResourceException("Could not find a path for request");
        }

        if (static::$CUSTOM_PREFIX) {
            $match = preg_replace("/^\/?/", "", static::$CUSTOM_PREFIX) . "/$match";
        }
        return $match;
    }

    /**
     * @return static[]
     */
    private static function createInstancesFromResponse(RestResponse $response, Session $session): array
    {
        $objects = [];

        $body = $response->getDecodedBody();
        $className = static::getJsonBodyName();
        $pluralClass = self::pluralize($className);

        if (!empty($body)) {
            if (array_key_exists($pluralClass, $body)) {
                foreach ($body[$pluralClass] as $entry) {
                    array_push($objects, self::createInstance($entry, $session));
                }
            } elseif (array_key_exists($className, $body) && array_key_exists(0, $body[$className])) {
                foreach ($body[$className] as $entry) {
                    array_push($objects, self::createInstance($entry, $session));
                }
            } elseif (array_key_exists($className, $body)) {
                array_push($objects, self::createInstance($body[$className], $session));
            }
        }

        return $objects;
    }

    /**
     * @return static
     */
    private static function createInstance(array $data, Session $session, &$instance = null)
    {
        $instance = $instance ?: new static($session);

        if (!empty($data)) {
            self::setInstanceData($instance, $data);
        }

        return $instance;
    }

    private static function isHasManyAttribute(string $property): bool
    {
        return array_key_exists($property, static::$HAS_MANY);
    }

    private static function isHasOneAttribute(string $property): bool
    {
        return array_key_exists($property, static::$HAS_ONE);
    }

    private static function pluralize(string $str): string
    {
        $inflector = InflectorFactory::create()->build();
        return $inflector->pluralize($str);
    }

    private static function setInstanceData(self &$instance, array $data): void
    {
        $instance->originalState = [];

        foreach ($data as $prop => $value) {
            if (self::isHasManyAttribute($prop)) {
                $attrList = [];
                if (!empty($value)) {
                    foreach ($value as $elementData) {
                        array_push(
                            $attrList,
                            static::$HAS_MANY[$prop]::createInstance($elementData, $instance->session)
                        );
                    }
                }

                $instance->setProperty($prop, $attrList);
            } elseif (self::isHasOneAttribute($prop)) {
                if (!empty($value)) {
                    $instance->setProperty(
                        $prop,
                        static::$HAS_ONE[$prop]::createInstance($value, $instance->session)
                    );
                }
            } else {
                $instance->setProperty($prop, $value);
                $instance->originalState[$prop] = $value;
            }
        }
    }

    private static function dataDiff(array $data1, array $data2): array
    {
        $diff = array();

        foreach ($data1 as $key1 => $value1) {
            if (array_key_exists($key1, $data2)) {
                if (is_array($value1)) {
                    $recursiveDiff = self::dataDiff($value1, $data2[$key1]);
                    if (count($recursiveDiff)) {
                        $diff[$key1] = $recursiveDiff;
                    }
                } else {
                    if ($value1 != $data2[$key1]) {
                        $diff[$key1] = $value1;
                    }
                }
            } else {
                $diff[$key1] = $value1;
            }
        }
        return $diff;
    }

    private function setProperty(string $name, $value): void
    {
        $this->$name = $value;
        $this->setProps[$name] = $value;
    }

    private function getProperties(): array
    {
        $reflection = new ReflectionClass(static::class);
        $docBlock = $reflection->getDocComment();
        $lines = explode("\n", $docBlock);

        $props = [];
        foreach ($lines as $line) {
            preg_match("/[\s\*]+@property\s+[^\s]+\s+\\$(.*)/", $line, $matches);
            if (empty($matches)) {
                continue;
            }

            $props[] = $matches[1];
        }

        return array_unique(array_merge($props, array_keys($this->setProps)));
    }
}
