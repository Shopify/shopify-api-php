<?php

declare(strict_types=1);

namespace Shopify\Clients;

use Shopify\Context;

final class Payments extends Graphql
{
    /**
     * @inheritDoc
     */
    protected function getApiPath(): string
    {
        return 'payments_apps/api/' . Context::$API_VERSION . '/graphql.json';
    }
}
