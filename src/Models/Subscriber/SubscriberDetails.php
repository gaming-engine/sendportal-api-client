<?php

namespace GamingEngine\SendPortalAPI\Models\Subscriber;

use GamingEngine\SendPortalAPI\Models\Tag\Tag;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;

class SubscriberDetails extends Subscriber
{
    /** @var Tag[] */
    #[CastWith(ArrayCaster::class, itemType: Tag::class)]
    public array $tags;
}
