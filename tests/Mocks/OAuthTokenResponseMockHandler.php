<?php

namespace Tests\Mocks;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class OAuthTokenResponseMockHandler extends MockHandler
{
    public static function create(): self {
        return new self([
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                <<<JSON
                {
                    "access_token": "6qrZcUqja7812RVdnEKjpzOL4CvHBFG",
                    "token_type": "Bearer",
                    "expires_in": 604800,
                    "refresh_token": "D43f5y0ahjqew82jZ4NViEr2YafMKhue",
                    "scope": "identify"
                }
                JSON
            )
        ]);
    }
}
