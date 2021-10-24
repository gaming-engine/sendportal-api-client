<?php

namespace GamingEngine\SendPortalAPI\Models;

use DateTime;
use GamingEngine\SendPortalAPI\Casters\DateTimeCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class Template extends DataTransferObject
{
    public int $id;
    
    public string $name;

    public string $content;

    #[CastWith(DateTimeCaster::class)]
    public DateTime $created_at;

    #[CastWith(DateTimeCaster::class)]
    public DateTime $updated_at;
}
