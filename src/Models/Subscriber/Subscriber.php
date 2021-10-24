<?php

namespace GamingEngine\SendPortalAPI\Models\Subscriber;

use DateTime;
use GamingEngine\SendPortalAPI\Casters\DateTimeCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class Subscriber extends DataTransferObject
{
    public int $id;

    public string $first_name;

    public string $last_name;

    public string $email;

    #[CastWith(DateTimeCaster::class)]
    public ?DateTime $unsubscribed_at;

    #[CastWith(DateTimeCaster::class)]
    public DateTime $created_at;

    #[CastWith(DateTimeCaster::class)]
    public DateTime $updated_at;
}
