<?php

namespace GamingEngine\SendPortalAPI\Models\Http;

use Spatie\DataTransferObject\DataTransferObject;

class PaginatedResponse extends DataTransferObject
{
    public array $data = [];

    public ?Metadata $meta;

    public function hasNextPage()
    {
        if (null === $this->meta) {
            return false;
        }

        return $this->meta->hasNextPage();
    }

    public function currentPage(): int
    {
        if (null === $this->meta) {
            return 1;
        }

        return $this->meta->current_page;
    }
}
