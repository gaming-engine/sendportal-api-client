<?php

namespace GamingEngine\SendPortalAPI\Http;

use GamingEngine\SendPortalAPI\Models\Request;
use GuzzleHttp\Client;

class GuzzleHttpClient implements HttpClientInterface
{
    private string $baseUri;
    private array $headers = array();

    public function __construct(private Client $client)
    {
        $this->setHeader('Content-Type', 'application/json');
    }

    function setHeader(string $key, string $value): self
    {
        $this->headers[$key] = $value;

        return $this;
    }

    function getBaseUri(): ?string
    {
        return $this->baseUri ?? null;
    }

    function setBaseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    function getHeaders(): array
    {
        return $this->headers;
    }

    function setHeaders(array $values): self
    {
        foreach ($values as $key => $value) {
            $this->setHeader($key, $value);
        }

        return $this;
    }

    function get(string $uri, array $headers = []): mixed
    {
        return $this->fire(
            (new Request())
                ->setMethod('GET')
                ->setUri($this->normalizeUri($uri))
                ->setHeaders(array_merge($this->headers, $headers))
        );
    }

    private function fire(Request $request): mixed
    {
        $response = $this->client->request(
            $request->method(),
            $request->uri(),
            [
                'headers' => $request->headers(),
                'json' => $request->data(),
            ]
        );

        return json_decode(
            $response->getBody()
        );
    }

    private function normalizeUri(string $uri): string
    {
        if (!isset($this->baseUri)) {
            return $uri;
        }

        if ($uri[0] === '/' && str_ends_with($this->baseUri, '/')) {
            $uri = substr($uri, 0, strlen($uri) - 1);
        } elseif (!str_ends_with($this->baseUri, '/')) {
            $uri = "/$uri";
        }

        return $this->baseUri . $uri;
    }

    function post(string $uri, array $data, array $headers = []): mixed
    {
        return $this->fire(
            (new Request())
                ->setMethod('POST')
                ->setUri($this->normalizeUri($uri))
                ->setData($data)
                ->setHeaders(array_merge($this->headers, $headers))
        );
    }
}
