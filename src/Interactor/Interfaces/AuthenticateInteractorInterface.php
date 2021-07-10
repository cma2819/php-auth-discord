<?php

namespace AuthDiscord\Interactor\Interfaces;

use AuthDiscord\DataObjects\Scopes\OAuthScope;

interface AuthenticateInteractorInterface
{
    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $code
     * @param string $redirectUrl
     * @param string[] $scopes
     * @return string
     */
    public function getAuthenticateToken(string $clientId, string $clientSecret, string $code, string $redirectUrl, array $scopes): string;

    public function buildDiscordOAuthUri(string $clientId, string $state, string $redirectUrl, array $scopes): string;
}
