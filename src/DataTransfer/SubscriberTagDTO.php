<?php

namespace GamingEngine\SendPortalAPI\DataTransfer;

use Spatie\DataTransferObject\DataTransferObject;

class SubscriberTagDTO extends DataTransferObject
{
    /**
     * @var int[]
     */
    public array $tags = [];
}
