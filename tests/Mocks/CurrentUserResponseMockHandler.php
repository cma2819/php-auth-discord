<?php

namespace Tests\Mocks;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class CurrentUserResponseMockHandler extends MockHandler
{
    public static function create(): self
    {
        return new self([
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                <<<'JSON'
                {
                    "id": "80351110224678912",
                    "username": "Nelly",
                    "discriminator": "1337",
                    "bot": false,
                    "system": true,
                    "mfa_enabled": true,
                    "avatar": "8342729096ea3675442027381ff50dfe",
                    "verified": true,
                    "email": "nelly@discord.com",
                    "flags": 64,
                    "premium_type": 1,
                    "public_flags": 64
                }
                JSON
            )
        ]);
    }
}
