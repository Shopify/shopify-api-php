<?php

declare(strict_types=1);

namespace Shopify\Webhooks;

final class ProcessResponse
{
    /** @var bool */
    private bool $success;
    /** @var string|null */
    private string|null $errorMessage = null;
    /** @var mixed */
    private mixed $body = null;

    public function __construct(bool $success)
    {
        $this->success = $success;
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

    /**
     * Sets the error message.
     *
     * @param string $errorMessage
     * @return ProcessResponse
     */
    public function setErrorMessage(string $errorMessage): ProcessResponse
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    /**
     * Returns the response, if the webhook handler has provided it.
     *
     * @return mixed
     */
    public function getBody(): mixed
    {
        return $this->body;
    }

    /**
     * Sets the response.
     *
     * @param mixed $body
     * @return ProcessResponse
     */
    public function setBody(mixed $body): ProcessResponse
    {
        $this->body = $body;

        return $this;
    }
}
