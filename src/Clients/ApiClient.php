<?php

namespace GamingEngine\SendPortalAPI\Clients;

use GamingEngine\SendPortalAPI\Http\HttpClientInterface;
use GamingEngine\SendPortalAPI\Models\Configuration;
use GamingEngine\SendPortalAPI\Models\Http\PaginatedResponse;

class ApiClient implements ApiClientInterface
{
    public function __construct(
        private Configuration $configuration,
        private HttpClientInterface $client
    ) {
    }

    public function get(string $uri): mixed
    {
        $response = new PaginatedResponse($this->client->get(
            $this->normalizeUri($uri),
            $this->headers()
        ));

        $data = $response->data;

        while ($response->hasNextPage()) {
            $response = new PaginatedResponse($this->client->get(
                $this->normalizeUri($uri) . '?page=' . ($response->currentPage() + 1),
                $this->headers()
            ));

            $data = [
                ...$data,
                ...$response->data,
            ];
        }

        return $data;
    }

    private function normalizeUri(string $uri): string
    {
        $baseUri = $this->configuration->baseUri();

        if (!str_ends_with($baseUri, '/')) {
            $baseUri .= '/';
        }

        $baseUri .= 'api/v1';

        if ('/' !== $uri[0]) {
            $uri = "/$uri";
        }

        return $baseUri . $uri;
    }

    private function headers(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->configuration->bearerToken(),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
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

    public function put(string $uri, array $data): mixed
    {
        return $this->client->put(
            $this->normalizeUri($uri),
            $data,
            $this->headers()
        );
    }

    public function delete(string $uri): void
    {
        $this->client->delete(
            $this->normalizeUri($uri),
            $this->headers()
        );
    }
}
