<?php

namespace GamingEngine\SendPortalAPI\Clients;

abstract class BaseClient
{
    public function __construct(protected ApiClientInterface $client)
    {
    }

    protected function mapInto(array $data, string $targetClass): array|object
    {
        if (empty($data)) {
            return [];
        }

        if (array_key_exists(0, $data)) {
            return array_map(
                fn(array $values) => $this->mapInto($values, $targetClass),
                $data
            );
        }

        return new $targetClass($data);
    }
}
