<?php

namespace Tests;

use AuthDiscord\AuthDiscord;
use AuthDiscord\CredentialScope;
use PHPUnit\Framework\TestCase;

class BuildDiscordOAuthUriTest extends TestCase
{
    /** @test */
    public function testSuccessToBuild()
    {
        $authDiscord = new AuthDiscord();

        $result = $authDiscord->buildDiscordOAuthUri(
            '123456789',
            'staterandom',
            'https://redirect.example.com',
            [
                CredentialScope::IDENTIFY,
                CredentialScope::EMAIL,
                CredentialScope::GUILDS,
            ]
        );

        $this->assertEquals(
            'https://discord.com/api/oauth2/authorize?response_type=code&client_id=123456789&scope=identify+email+guilds&state=staterandom&redirect_url=https%3A%2F%2Fredirect.example.com&prompt=consent',
            $result
        );
    }

}
