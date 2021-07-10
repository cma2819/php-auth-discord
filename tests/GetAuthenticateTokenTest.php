<?php

namespace Tests;

use AuthDiscord\AuthDiscord;
use AuthDiscord\AuthenticateClient;
use AuthDiscord\CredentialScope;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\OAuthTokenResponseMockHandler;

class GetAuthenticateTokenTest extends TestCase
{
    /** @test */
    public function testSuccessToGet()
    {
        $stack = HandlerStack::create(OAuthTokenResponseMockHandler::create());
        $authDiscord = new AuthDiscord(
            new AuthenticateClient([
                'handler' => $stack,
            ])
        );

        $result = $authDiscord->getAuthenticateToken(
            'client_id',
            'client_secret',
            'codestring',
            'https://example.com',
            [
                CredentialScope::IDENTIFY,
                CredentialScope::EMAIL,
            ]
        );

        $this->assertEquals('6qrZcUqja7812RVdnEKjpzOL4CvHBFG', $result);
    }

}
