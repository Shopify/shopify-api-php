<?php

namespace Shopify\Clients;

class TransportFactory
{
    /**
     * @return \Shopify\Clients\Transport Http transport
     */
    public function transport(): Transport
    {
        return new Curl();
    }
}
