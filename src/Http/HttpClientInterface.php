<?php

namespace GamingEngine\SendPortalAPI\Http;

interface HttpClientInterface
{
    function setHeader(string $key, string $value): self;

    function setHeaders(array $values): self;

    function get(string $uri, array $headers = []): mixed;

    function post(string $uri, array $data, array $headers = []): mixed;

    function put(string $uri, array $data, array $headers = []): mixed;

    function delete(string $uri, array $headers = []): void;
}
