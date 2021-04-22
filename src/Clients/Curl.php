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
        $curlError = curl_error($this->ch);
        curl_close($this->ch);
        if ($curlError) {
            throw new HttpRequestException("HTTP request failed: $curlError");
        }
        return $response;
    }

    /**
     * @codeCoverageIgnore We can't test this without making actual requests
     */
    private function executeRequest(): ?array
    {
        $headers = new HttpHeaders();
        $this->setCurlOption(
            CURLOPT_HEADERFUNCTION,
            function ($curl, $header) use (&$headers) {
                return $headers->addRawHeader($header);
            }
        );

        $responseBody = curl_exec($this->ch);
        if (!$responseBody) {
            return null;
        }

        $statusCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        return [
            'statusCode' => $statusCode,
            'headers' => $headers,
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
