<?php

namespace Tests;

use AuthDiscord\AuthenticateClient;
use PHPUnit\Framework\TestCase;

/**
 * AuthenticateClientTest
 */
class AuthenticateClientTest extends TestCase
{
    /** @test */
    public function testDefaultRequestUri()
    {
        $client = new AuthenticateClient();

        $baseUri = $client->getConfig('base_uri');

        $this->assertEquals(
            'https://discord.com/api/oauth2/',
            $baseUri
        );
    }
}
