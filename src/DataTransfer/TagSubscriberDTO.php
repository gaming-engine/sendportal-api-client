<?php

namespace GamingEngine\SendPortalAPI\DataTransfer;

use Spatie\DataTransferObject\DataTransferObject;

class TagSubscriberDTO extends DataTransferObject
{
    /**
     * @var int[]
     */
    public array $subscribers = [];
}
