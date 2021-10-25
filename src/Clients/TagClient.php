<?php

namespace GamingEngine\SendPortalAPI\Clients;

use GamingEngine\SendPortalAPI\DataTransfer\TagDTO;
use GamingEngine\SendPortalAPI\Models\Tag\Tag;

class TagClient extends BaseClient
{
    /**
     * @return Tag[]
     */
    public function retrieve(): array
    {
        return $this->mapInto(
            $this->client->get('tags'),
            Tag::class
        );
    }

    public function get(int $tagId): Tag
    {
        return $this->mapInto(
            $this->client->get("tags/$tagId"),
            Tag::class
        );
    }

    public function create(TagDTO $tag): Tag
    {
        return $this->mapInto(
            $this->client->post(
                'tags',
                (array)$tag
            ),
            Tag::class
        );
    }

    public function update(int $tagId, TagDTO $tag): Tag
    {
        return $this->mapInto(
            $this->client->put(
                "tags/$tagId",
                (array)$tag
            ),
            Tag::class
        );
    }

    public function delete(int $tagId): void
    {
        $this->client->delete("tags/$tagId");
    }
}
