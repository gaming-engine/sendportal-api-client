<?php

namespace GamingEngine\SendPortalAPI\Http;

use GamingEngine\SendPortalAPI\Models\Request;
use GuzzleHttp\Client;

class GuzzleHttpClient implements HttpClientInterface
{
    private string $baseUri;

    private array $headers = array();

    public function __construct(public Client $client)
    {
        $this->setHeader('CONTENT_TYPE', 'application/json');
    }

    function setBaseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;
    }

    function setHeader(string $key, string $value): self
    {
        $this->headers[$key] = $value;
    }

    function setHeaders(array $values): self
    {
        foreach($values as $key => $value) {
            $this->setHeader($key, $value);
        }
    }

    function get(string $uri, array $headers): mixed
    {
        return $this->fire(
            (new Request())
                ->setMethod('GET')
                ->setUri($this->normalizeUri($uri))
                ->setHeaders($headers)
        );
    }

    function post(string $uri, array $data, array $headers): mixed
    {
        return $this->fire(
            (new Request())
                ->setMethod('POST')
                ->setUri($this->normalizeUri($uri))
                ->setData($data)
                ->setHeaders($headers)
        );
    }

    private function normalizeUri($uri): string
    {
        if(!isset($this->baseUri)) {
            return $uri;
        }

        if($uri[0] === '/' && str_ends_with($this->baseUri, '/')) {
            $uri = substr($uri, 0, strlen($uri) - 1);
        }

        return $this->baseUri . $uri;
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
}
