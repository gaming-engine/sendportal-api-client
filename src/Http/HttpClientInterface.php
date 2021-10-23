<?php

namespace GamingEngine\SendPortalAPI\Http;

interface HttpClientInterface
{
    function setBaseUrl(string $baseUrl): self;

    function setHeader(string $key, string $value): self;

    function setHeaders(array $values): self;

    function get(string $url, array $headers): mixed;

    function post(string $url, array $data, array $headers): mixed;
}
