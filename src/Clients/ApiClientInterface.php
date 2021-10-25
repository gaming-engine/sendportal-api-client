<?php

namespace GamingEngine\SendPortalAPI\Clients;

interface ApiClientInterface
{
    function get(string $uri): mixed;

    function post(string $uri, array $data): mixed;

    function put(string $uri, array $data): mixed;

    function delete(string $uri, array $data = []): mixed;
}
