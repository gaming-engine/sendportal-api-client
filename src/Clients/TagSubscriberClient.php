<?php

namespace GamingEngine\SendPortalAPI\Clients;

use GamingEngine\SendPortalAPI\DataTransfer\TagSubscriberDTO;
use GamingEngine\SendPortalAPI\Models\Subscriber\Subscriber;

class TagSubscriberClient extends BaseClient
{
    /**
     * @return Subscriber[]
     */
    public function retrieve(int $tagId): array
    {
        return $this->mapInto(
            $this->client->get("tags/$tagId/subscribers"),
            Subscriber::class
        );
    }

    /**
     * @param int $tagId
     * @param TagSubscriberDTO $subscriber
     * @return Subscriber[]
     */
    public function create(int $tagId, TagSubscriberDTO $subscriber): array
    {
        return $this->mapInto(
            $this->client->post(
                "tags/$tagId/subscribers",
                (array)$subscriber
            ),
            Subscriber::class
        );
    }

    /**
     * @param int $tagId
     * @param TagSubscriberDTO $subscriber
     * @return Subscriber[]
     */
    public function update(int $tagId, TagSubscriberDTO $subscriber): array
    {
        return $this->mapInto(
            $this->client->put(
                "tags/$tagId/subscribers",
                (array)$subscriber
            ), Subscriber::class
        );
    }

    /**
     * @param int $tagId
     * @param TagSubscriberDTO $subscriber
     * @return Subscriber[]
     */
    public function delete(int $tagId, TagSubscriberDTO $subscriber): array
    {
        return $this->mapInto(
            $this->client->delete(
                "tags/$tagId/subscribers",
                (array)$subscriber
            ), Subscriber::class);
    }
}
