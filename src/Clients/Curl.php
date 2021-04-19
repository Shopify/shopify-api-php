<?php

namespace Shopify\Clients;

use CurlHandle;
use Shopify\Exception\HttpRequestException;

class Curl implements Transport
{

    private CurlHandle $ch;

    /**
     * {@inheritDoc}
     * @codeCoverageIgnore We can't test this without making actual requests
     */
    public function sendRequest(): ?array
    {
        $response = $this->executeRequest();
        if ($curlError = curl_error($this->ch)) {
            throw new HttpRequestException("HTTP request failed: $curlError");
        }
        return $response;
    }

    /**
     * @codeCoverageIgnore We can't test this without making actual requests
     */
    private function executeRequest(): ?array
    {
        $responseHeaders = [];
        $this->setCurlOption(
            CURLOPT_HEADERFUNCTION,
            function ($curl, $header) use (&$responseHeaders) {
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) < 2) {
                    return $len;
                }

                $responseHeaders[strtolower(trim($header[0]))][] = trim($header[1]);

                return $len;
            }
        );

        $responseBody = curl_exec($this->ch);
        if (!$responseBody) {
            return null;
        }

        $statusCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        return [
            'statusCode' => $statusCode,
            'headers' => $responseHeaders,
            'body' => $responseBody,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function setBody(string $body): void
    {
        $this->setCurlOption(CURLOPT_POSTFIELDS, $body);
    }

    /**
     * {@inheritDoc}
     */
    public function setHeader(array $header): void
    {
        $this->setCurlOption(CURLOPT_HTTPHEADER, $header);
    }

    /**
     * {@inheritDoc}
     */
    public function setUserAgent(string $agent): void
    {
        $this->setCurlOption(CURLOPT_USERAGENT, $agent);
    }

    /**
     * {@inheritDoc}
     */
    public function setMethod(string $method): void
    {
        switch ($method) {
            case "POST":
                $this->setCurlOption(CURLOPT_POST, true);
                break;
            case "PUT":
                $this->setCurlOption(CURLOPT_CUSTOMREQUEST, "PUT");
                break;
            case "DELETE":
                $this->setCurlOption(CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
        }
    }

    /**
     * @codeCoverageIgnore We can't test this without making actual requests
     */
    public function setCurlOption(int $option, mixed $value)
    {
        curl_setopt($this->ch, $option, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function initializeRequest(string $url)
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $url);
        $this->setCurlOption(CURLOPT_RETURNTRANSFER, true);
    }

    public function getUrl(): string
    {
        return curl_getinfo($this->ch, CURLINFO_EFFECTIVE_URL);
    }
}
