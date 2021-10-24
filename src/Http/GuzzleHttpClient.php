<?php

namespace GamingEngine\SendPortalAPI\Http;

use GamingEngine\SendPortalAPI\Models\Request;
use GuzzleHttp\Client;

class GuzzleHttpClient implements HttpClientInterface
{
    private array $headers = array();

    public function __construct(private Client $client)
    {
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

    function setHeader(string $key, string $value): self
    {
        $this->headers[$key] = $value;

        return $this;
    }

    function get(string $uri, array $headers = []): mixed
    {
        return $this->fire(
            (new Request())
                ->setMethod('GET')
                ->setUri($uri)
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
            $response->getBody(),
            true
        );
    }

    function post(string $uri, array $data, array $headers = []): mixed
    {
        return $this->fire(
            (new Request())
                ->setMethod('POST')
                ->setUri($uri)
                ->setData($data)
                ->setHeaders(array_merge($this->headers, $headers))
        )['data'];
    }

    function put(string $uri, array $data, array $headers = []): mixed
    {
        return $this->fire(
            (new Request())
                ->setMethod('PUT')
                ->setUri($uri)
                ->setData($data)
                ->setHeaders(array_merge($this->headers, $headers))
        )['data'];
    }

    function delete(string $uri, array $headers = []): void
    {
        $this->fire(
            (new Request())
                ->setMethod('DELETE')
                ->setUri($uri)
                ->setHeaders(array_merge($this->headers, $headers))
        );
    }
}
