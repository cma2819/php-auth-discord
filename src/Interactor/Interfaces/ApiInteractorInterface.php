<?php

namespace AuthDiscord\Interactor\Interfaces;

use AuthDiscord\DataObjects\User;

interface ApiInteractorInterface
{
    public function getCurrentUser(string $token): User;
}
