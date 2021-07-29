<?php

declare(strict_types=1);

namespace Shopify\Webhooks;

final class RegisterResponse
{
    /** @var bool */
    private $success;
    /** @var string|array|null */
    private $body;

    /**
     * @param bool              $success
     * @param string|array|null $body
     */
    public function __construct(bool $success, $body)
    {
        $this->success = $success;
        $this->body = $body;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return string|array|null
     */
    public function getBody()
    {
        return $this->body;
    }
}
