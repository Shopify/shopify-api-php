<?php

declare(strict_types=1);

namespace Shopify\Webhooks;

final class ProcessResponse
{
    public function __construct(private bool $success, private ?string $errorMessage = null)
    {
    }

    /**
     * Whether the webhook was processed.
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * Returns the error message, if the webhook wasn't processed.
     *
     * @return string|null
     */
    public function getErrorMessage(): string | null
    {
        return $this->errorMessage;
    }
}
