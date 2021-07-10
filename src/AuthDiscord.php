<?php

namespace AuthDiscord;

use AuthDiscord\DataObjects\User;
use AuthDiscord\Interactor\ApiInteractor;
use AuthDiscord\Interactor\AuthenticateInteractor;
use AuthDiscord\Interactor\Interfaces\ApiInteractorInterface;
use AuthDiscord\Interactor\Interfaces\AuthenticateInteractorInterface;

class AuthDiscord implements ApiInteractorInterface, AuthenticateInteractorInterface
{
    protected AuthenticateClient $authClient;

    protected Client $client;

    public function __construct(
        ?AuthenticateClient $authClient = null,
        ?Client $client = null
    ) {
        if (is_null($authClient)) {
            $authClient = new AuthenticateClient();
        }

        if (is_null($client)) {
            $client = new Client();
        }

        $this->authClient = $authClient;
        $this->client = $client;
    }

    public function getCurrentUser(
        string $token
    ): User {
        $interactor = new ApiInteractor($this->client);

        return $interactor->getCurrentUser($token);
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $code
     * @param string $redirectUrl
     * @param OAuthScope $scopes
     * @return string
     */
    public function getAuthenticateToken(string $clientId, string $clientSecret, string $code, string $redirectUrl, array $scopes): string
    {
        $interactor = new AuthenticateInteractor($this->authClient);

        return $interactor->getAuthenticateToken($clientId, $clientSecret, $code, $redirectUrl, $scopes);
    }

    public function buildDiscordOAuthUri(string $clientId, string $state, string $redirectUrl, array $scopes): string
    {
        $interactor = new AuthenticateInteractor($this->authClient);

        return $interactor->buildDiscordOAuthUri($clientId, $state, $redirectUrl, $scopes);
    }
}
