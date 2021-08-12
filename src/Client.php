<?php

namespace AuthDiscord;

use GuzzleHttp\Client as GuzzleHttpClient;

class Client extends GuzzleHttpClient {

    protected const API_BASE_URI = 'https://discord.com/api/v9/';

    function __construct(
        ?array $guzzleOption = []
    ) {
        parent::__construct(array_merge([
            'base_uri' => self::API_BASE_URI,
        ], $guzzleOption));
    }
}
