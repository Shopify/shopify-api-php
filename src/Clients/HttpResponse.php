<?php

declare(strict_types=1);

namespace Shopify\Clients;

class HttpResponse
{
    public int $statusCode;
    public array $headers = [];
    public string | array | null $body = null;
}
