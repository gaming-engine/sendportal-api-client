<?php

namespace GamingEngine\SendPortalAPI\Clients;

interface ClientInterface
{
    function get(string $uri): mixed;

    function post(string $uri, array $data): mixed;

    function put(string $uri, array $data): mixed;

    function delete(string $uri): void;
}
