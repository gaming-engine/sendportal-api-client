<?php

namespace GamingEngine\SendPortalAPI;

use GamingEngine\SendPortalAPI\Http\HttpClientInterface;
use GamingEngine\SendPortalAPI\Models\Configuration;

class Client
{
    public function __construct(
        private Configuration $configuration,
        private HttpClientInterface $client
    ) {
    }

    public function get(string $uri): mixed
    {
        return $this->client->get(
            $this->normalizeUri($uri),
            $this->headers()
        );
    }

    private function normalizeUri(string $uri): string
    {
        $baseUri = $this->configuration->baseUri();

        if ($uri[0] === '/' && str_ends_with($baseUri, '/')) {
            $uri = substr($uri, 0, strlen($uri) - 1);
        } elseif (!str_ends_with($baseUri, '/')) {
            $uri = "/$uri";
        }

        return $baseUri . $uri;
    }

    private function headers(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->configuration->bearerToken(),
        ];
    }

    public function post(string $uri, array $data): mixed
    {
        return $this->client->post(
            $this->normalizeUri($uri),
            $data,
            $this->headers()
        );
    }
}
