<?php

namespace GamingEngine\SendPortalAPI\DataTransfer;

use Spatie\DataTransferObject\DataTransferObject;

class CampaignDTO extends DataTransferObject
{
    public string $name;

    public string $content;

    public int $template_id;

    public int $email_service_id;

    public string $from_name;

    public string $from_email;

    public ?bool $is_open_tracking;

    public ?bool $is_click_tracking;

    public ?bool $send_to_all;

    /**
     * @var int[]
     */
    public array $tags;

    public ?bool $save_as_draft;
}
