<?php

namespace AuthDiscord\DataObjects;

class Snowflake
{
    protected string $value;

    public function __construct(
        string $value
    ) {
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
