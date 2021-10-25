<?php

namespace GamingEngine\SendPortalAPI\Tests\Clients;

use GamingEngine\SendPortalAPI\Clients\BaseClient;

class SampleClient extends BaseClient
{
    public function get(array $data, string $targetClass)
    {
        return $this->mapInto($data, $targetClass);
    }
}
