<?php

namespace AuthDiscord\Exceptions;

use Exception;
use Throwable;

final class UnknownStatusException extends Exception
{
    public function __construct(
        int $code,
        Throwable $previous = null
    ) {
        parent::__construct(
            'Received http status code is unknown.',
            $code,
            $previous
        );
    }
}
