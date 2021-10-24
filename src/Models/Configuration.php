<?php

namespace GamingEngine\SendPortalAPI\Models;

class Configuration
{
    public function __construct(private string $baseUri, private string $bearerToken)
    {
    }

    public function baseUri(): string
    {
        return $this->baseUri;
    }

    public function bearerToken(): string
    {
        return $this->bearerToken;
    }
}
