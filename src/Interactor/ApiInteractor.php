<?php

namespace AuthDiscord\Interactor;

use AuthDiscord\Client;
use AuthDiscord\DataObjects\User;
use AuthDiscord\Interactor\Interfaces\ApiInteractorInterface;
use GuzzleHttp\RequestOptions;

final class ApiInteractor extends Interactor implements ApiInteractorInterface
{
    protected Client $client;

    public function __construct(
        Client $client
    ) {
        $this->client = $client;
    }

    public function getCurrentUser(string $token): User
    {
        return $this->interact(function () use ($token) {
            $response = $this->client->get('users/@me', [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $token,
                ]
            ]);

            return User::createFromApiJson(json_decode($response->getBody(), true));
        });
    }
}
