<?php

namespace GamingEngine\SendPortalAPI\Models\Tag;

use DateTime;
use GamingEngine\SendPortalAPI\Casters\DateTimeCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class Tag extends DataTransferObject
{
    public int $id;

    public string $name;

    #[CastWith(DateTimeCaster::class)]
    public DateTime $created_at;

    #[CastWith(DateTimeCaster::class)]
    public DateTime $updated_at;
}
