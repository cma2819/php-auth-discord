<?php

namespace AuthDiscord;

use GuzzleHttp\Client as GuzzleHttpClient;

class AuthenticateClient extends GuzzleHttpClient {

    protected const API_BASE_URI = 'https://discord.com/api/oauth2';

    function __construct(
        ?array $guzzleOption = []
    ) {
        parent::__construct(array_merge([
            'base_uri' => self::API_BASE_URI,
        ], $guzzleOption));
    }
}
