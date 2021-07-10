<?php

namespace Tests\Mocks;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class NotFoundResponseMockHandler extends MockHandler
{
    public static function create(): self
    {
        return new self([
            new Response(
                404,
                ['Content-Type: application/json'],
                <<<JSON
                {
                    "message": "Invalid OAuth2 access token provided",
                    "code": 50025
                }
                JSON
            )
        ]);
    }
}
