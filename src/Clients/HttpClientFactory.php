<?php

namespace Shopify\Clients;

use GuzzleHttp\Client;
use Psr\Http\Client\ClientInterface;

class HttpClientFactory
{
    public function client(): ClientInterface
    {
        return new Client();
    }
}
