<?php

namespace AuthDiscord\DataObjects;

use JsonSerializable;

class User implements JsonSerializable
{
    protected Snowflake $id;

    protected string $username;

    protected string $discriminator;

    protected ?string $avatar;

    protected ?bool $bot;

    protected ?bool $system;

    protected ?bool $mfaEnabled;

    protected ?string $locale;

    protected ?bool $verified;

    protected ?string $email;

    protected ?int $flags;

    protected ?int $premiumType;

    protected ?int $publicFlags;

    protected function __construct(
        Snowflake $id,
        string $username,
        string $discriminator,
        ?string $avatar,
        ?bool $bot,
        ?bool $system,
        ?bool $mfaEnabled,
        ?string $locale,
        ?bool $verified,
        ?string $email,
        ?int $flags,
        ?int $premiumType,
        ?int $publicFlags
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->discriminator = $discriminator;
        $this->avatar = $avatar;
        $this->bot = $bot;
        $this->system = $system;
        $this->mfaEnabled = $mfaEnabled;
        $this->locale = $locale;
        $this->verified = $verified;
        $this->email = $email;
        $this->flags = $flags;
        $this->premiumType = $premiumType;
        $this->publicFlags = $publicFlags;
    }

    public static function createFromApiJson(array $json)
    {
        return new self(
            new Snowflake($json['id']),
            $json['username'],
            $json['discriminator'],
            $json['avatar'] ?? null,
            $json['bot'] ?? null,
            $json['system'] ?? null,
            $json['mfa_enabled'] ?? null,
            $json['locale'] ?? null,
            $json['verified'] ?? null,
            $json['email'] ?? null,
            $json['flags'] ?? null,
            $json['premium_type'] ?? null,
            $json['public_flags'] ?? null
        );
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'discriminator' => $this->discriminator,
            'avatar' => $this->avatar,
            'bot' => $this->bot,
            'system' => $this->system,
            'mfa_enabled' => $this->mfaEnabled,
            'locale' => $this->locale,
            'verified' => $this->verified,
            'email' => $this->email,
            'flags' => $this->flags,
            'premium_type' => $this->premiumType,
            'public_flags' => $this->publicFlags,
        ];
    }
}
