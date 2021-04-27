<?php

declare(strict_types=1);

namespace Shopify\Clients;

use GuzzleHttp\Client;
use Psr\Http\Client\ClientInterface;

class HttpClientFactory
{
    /**
     * @codeCoverageIgnore This is mocked for tests
     */
    public function client(): ClientInterface
    {
        return new Client();
    }
}
