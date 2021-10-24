<?php

namespace GamingEngine\SendPortalAPI\Http;

interface HttpClientInterface
{
    function setBaseUri(string $baseUri): self;

    function setHeader(string $key, string $value): self;

    function setHeaders(array $values): self;

    function get(string $uri, array $headers = []): mixed;

    function post(string $uri, array $data, array $headers = []): mixed;
}
