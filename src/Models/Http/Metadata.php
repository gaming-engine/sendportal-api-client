<?php

namespace GamingEngine\SendPortalAPI\Models\Http;

use Spatie\DataTransferObject\DataTransferObject;

class Metadata extends DataTransferObject
{
    public int $current_page;

    public ?int $from;

    public int $last_page;

    public string $path;

    public int $per_page;

    public ?int $to;

    public int $total;

    public function hasNextPage(): bool
    {
        return $this->current_page < $this->last_page;
    }
}
