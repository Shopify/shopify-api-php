<?php

declare(strict_types=1);

namespace Shopify\Webhooks;

final class RegisterResponse
{
    public function __construct(private bool $success, private string | array | null $body)
    {
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getBody(): string | array | null
    {
        return $this->body;
    }
}
