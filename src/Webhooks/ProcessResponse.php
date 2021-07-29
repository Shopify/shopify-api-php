<?php

declare(strict_types=1);

namespace Shopify\Webhooks;

final class ProcessResponse
{
    /** @var bool */
    private $success;
    /** @var string|null */
    private $errorMessage = null;

    public function __construct(bool $success, ?string $errorMessage = null)
    {
        $this->success = $success;
        $this->errorMessage = $errorMessage;
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
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
}
