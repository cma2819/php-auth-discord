<?php

namespace AuthDiscord;

use AuthDiscord\DataObjects\User;
use AuthDiscord\Interactor\ApiInteractor;
use AuthDiscord\Interactor\AuthenticateInteractor;
use AuthDiscord\Interactor\Interfaces\ApiInteractorInterface;
use AuthDiscord\Interactor\Interfaces\AuthenticateInteractorInterface;

class AuthDiscord
{
    protected AuthenticateClient $authClient;

    protected Client $client;

    protected string $clientId;

    protected string $clientSecret;

    public function __construct(
        string $clientId,
        string $clientSecret,
        ?AuthenticateClient $authClient = null,
        ?Client $client = null
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;

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
     * @param string $code
     * @param string $redirectUrl
     * @param string[] $scopes
     * @return string
     */
    public function getAuthenticateToken(string $code, string $redirectUrl, array $scopes): string
    {
        $interactor = new AuthenticateInteractor($this->authClient);

        return $interactor->getAuthenticateToken($this->clientId, $this->clientSecret, $code, $redirectUrl, $scopes);
    }

    public function buildDiscordOAuthUri(string $state, string $redirectUrl, array $scopes): string
    {
        $interactor = new AuthenticateInteractor($this->authClient);

        return $interactor->buildDiscordOAuthUri($this->clientId, $state, $redirectUrl, $scopes);
    }
}
