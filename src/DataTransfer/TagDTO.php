<?php

namespace GamingEngine\SendPortalAPI\DataTransfer;

use Spatie\DataTransferObject\DataTransferObject;

class TagDTO extends DataTransferObject
{
    public string $name;

    /** @var int[] */
    public array $subscribers;
}
