<?php

namespace AuthDiscord\Exceptions;

use Throwable;

final class DiscordHttpExceptionFactory
{
    public static function makeException(
        string $statusCode,
        array $response,
        Throwable $previous = null
    ): DiscordHttpException {

        $errorType = substr($statusCode, 0, 1);

        switch ($errorType) {
            case '3':
                return new RedirectHttpException(
                    $statusCode,
                    $response,
                    $previous
                );
            case '4':
                return new ClientHttpException(
                    $statusCode,
                    $response,
                    $previous
                );
            case '5':
                return new ServerHttpException(
                    $statusCode,
                    $response,
                    $previous
                );
            default:
                throw new UnknownStatusException(
                    $statusCode,
                    $previous
                );
        }
    }
}
