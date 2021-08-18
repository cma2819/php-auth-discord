<?php

namespace Tests;

use AuthDiscord\AuthDiscord;
use AuthDiscord\Client;
use AuthDiscord\DataObjects\User;
use AuthDiscord\Exceptions\ClientHttpException;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\CurrentUserResponseMockHandler;
use Tests\Mocks\NotFoundResponseMockHandler;

class GetCurrentUserTest extends TestCase
{
    /** @test */
    public function testSuccessToGet()
    {
        $stack = HandlerStack::create(CurrentUserResponseMockHandler::create());
        $authDiscord = new AuthDiscord(
            'clientId',
            'clientSecret',
            null,
            new Client([
                'handler' => $stack,
            ])
        );

        $result = $authDiscord->getCurrentUser('token');

        $this->assertEquals(
            User::createFromApiJson([
                'id' => '80351110224678912',
                'username' => 'Nelly',
                'discriminator' => '1337',
                'bot' => false,
                'system' => true,
                'mfa_enabled' => true,
                'avatar' => '8342729096ea3675442027381ff50dfe',
                'locale' => null,
                'verified' => true,
                'email' => 'nelly@discord.com',
                'flags' => 64,
                'premium_type' => 1,
                'public_flags' => 64,
            ]),
            $result
        );
    }

    /** @test */
    public function testFailedByNotFound()
    {
        $stack = HandlerStack::create(NotFoundResponseMockHandler::create());
        $authDiscord = new AuthDiscord(
            'clientId',
            'clientSecret',
            null,
            new Client([
                'handler' => $stack,
            ])
        );

        $this->expectException(ClientHttpException::class);
        $authDiscord->getCurrentUser('token');
    }
}
