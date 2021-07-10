<?php

namespace AuthDiscord\Interactor;

use AuthDiscord\Exceptions\DiscordHttpExceptionFactory;
use Closure;
use GuzzleHttp\Exception\RequestException;

abstract class Interactor
{
    protected function interact(Closure $fn) {
        try {
            return $fn();
        } catch (RequestException $e) {
            $response = $e->getResponse();

            throw DiscordHttpExceptionFactory::makeException(
                strval($response->getStatusCode()),
                json_decode($response->getBody(), true),
            );
        }
    }
}
