<?php

namespace AuthDiscord\Interactor;

use AuthDiscord\AuthenticateClient;
use AuthDiscord\Interactor\Interfaces\AuthenticateInteractorInterface;
use GuzzleHttp\RequestOptions;

final class AuthenticateInteractor extends Interactor implements AuthenticateInteractorInterface
{
    protected const DISCORD_OAUTH_URL = 'https://discord.com/api/oauth2/authorize';

    protected AuthenticateClient $client;

    public function __construct(
        AuthenticateClient $client
    ) {
        $this->client = $client;
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $code
     * @param string $redirectUrl
     * @param string[] $scopes
     * @return string
     */
    public function getAuthenticateToken(string $clientId, string $clientSecret, string $code, string $redirectUrl, array $scopes): string
    {
        $parameters = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirectUrl,
            'scope' => implode(' ', $scopes),
        ];

        return $this->interact(function () use ($parameters) {
            $response = $this->client->post('token', [
                RequestOptions::FORM_PARAMS => $parameters,
            ]);

            return json_decode($response->getBody())->access_token;
        });
    }

    public function buildDiscordOAuthUri(string $clientId, string $state, string $redirectUrl, array $scopes): string
    {
        $discordAuthParams = [
            'response_type' => 'code',
            'client_id' => $clientId,
            'scope' => implode(' ', $scopes),
            'state' => $state,
            'redirect_url' => $redirectUrl,
            'prompt' => 'consent'
        ];
        $query = http_build_query($discordAuthParams);

        return self::DISCORD_OAUTH_URL . '?' . $query;
    }
}
