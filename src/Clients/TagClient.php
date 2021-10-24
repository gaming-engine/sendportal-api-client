<?php

namespace GamingEngine\SendPortalAPI\Clients;

use GamingEngine\SendPortalAPI\DataTransfer\TagDTO;
use GamingEngine\SendPortalAPI\Models\Tag\Tag;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class TagClient
{
    public function __construct(private ClientInterface $client)
    {
    }

    /**
     * @return Tag[]
     * @throws UnknownProperties
     */
    public function retrieve(): array
    {
        return array_map(
            fn($template) => new Tag($template),
            $this->client->get('tags')
        );
    }

    public function get(int $tagId): Tag
    {
        return new Tag(
            $this->client->get(
                "tags/$tagId"
            )
        );
    }

    public function create(TagDTO $tag): Tag
    {
        return new Tag(
            $this->client->post(
                'tags',
                (array)$tag
            )
        );
    }

    public function update(int $tagId, TagDTO $tag): Tag
    {
        return new Tag(
            $this->client->put(
                "tags/$tagId",
                (array)$tag
            )
        );
    }

    public function delete(int $tagId): void
    {
        $this->client->delete(
            "tags/$tagId"
        );
    }
}
