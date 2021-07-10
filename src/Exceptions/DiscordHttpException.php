<?php

namespace AuthDiscord\Exceptions;

use Exception;
use Throwable;

abstract class DiscordHttpException extends Exception
{
    protected string $statusCode;

    public function __construct(
        string $statusCode,
        array $response,
        Throwable $previous = null
    ) {
        $this->statusCode = $statusCode;

        parent::__construct(
            $response['message'],
            $response['code'],
            $previous
        );
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
