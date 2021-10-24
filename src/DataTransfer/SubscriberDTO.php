<?php

namespace GamingEngine\SendPortalAPI\DataTransfer;

use Spatie\DataTransferObject\DataTransferObject;

class SubscriberDTO extends DataTransferObject
{
    public string $first_name;

    public string $last_name;

    public string $email;

    /** @var int[] */
    public array $tags;
}
