<?php

namespace GamingEngine\SendPortalAPI\Models\Campaign;

use DateTime;
use GamingEngine\SendPortalAPI\Casters\DateTimeCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class Campaign extends DataTransferObject
{
    public int $id;

    public string $name;

    public string $content;

    public int $status_id;

    public int $template_id;

    public int $email_service_id;

    public string $from_name;

    public string $from_email;

    public bool $is_open_tracking;

    public bool $is_click_tracking;

    public int $sent_count;

    public int $open_count;

    public int $click_count;

    public bool $send_to_all;

    /**
     * @var int[]
     */
    public array $tags;

    public bool $save_as_draft;

    #[CastWith(DateTimeCaster::class)]
    public DateTime $scheduled_at;

    #[CastWith(DateTimeCaster::class)]
    public DateTime $created_at;

    #[CastWith(DateTimeCaster::class)]
    public DateTime $updated_at;
}
