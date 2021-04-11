<?php

namespace Shopify\Clients;

interface Transport
{

    /**
     * @param string $url URL
     */
    public function initializeRequest(string $url);

    /**
     * @param string $body The body of the request
     */
    public function setBody(string $body): void;

    /**
     * @param array $header Headers to send along with the request
     */
    public function setHeader(array $header): void;

    /**
     * @param string $agent User Agent
     */
    public function setUserAgent(string $agent): void;

    /**
     * @param string $method HTTP Method `PUT`, `POST`, `GET`, and `DELETE` supported
     */
    public function setMethod(string $method): void;

    /**
     * @return array|null Associated array with keys `body`, `error`, `headers`, and `error`
     * @throws \Shopify\Exception\HttpRequestException On transport errors
     * @codeCoverageIgnore We can't test this method without making actual cURL requests
     */
    public function sendRequest(): ?array;
}
