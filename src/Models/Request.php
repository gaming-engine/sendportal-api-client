<?php

namespace GamingEngine\SendPortalAPI\Models;

use GamingEngine\SendPortalAPI\Exceptions\InvalidMethodException;

class Request
{
    private string $method;
    private string $uri;
    private array $data = [];
    private array $headers = [];

    /**
     * @throws InvalidMethodException
     */
    public function setMethod(string $method): self
    {
        if (!in_array(strtoupper($method), ['GET', 'POST', 'PUT', 'DELETE'])) {
            throw new InvalidMethodException($method);
        }

        $this->method = strtoupper($method);

        return $this;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function setUri(string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    public function headers(): array
    {
        return $this->headers;
    }
}
