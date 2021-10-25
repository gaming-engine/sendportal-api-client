<?php

namespace GamingEngine\SendPortalAPI\Clients;

use GamingEngine\SendPortalAPI\DataTransfer\SubscriberTagDTO;
use GamingEngine\SendPortalAPI\Models\Tag\Tag;

class SubscriberTagClient extends BaseClient
{
    /**
     * @return Tag[]
     */
    public function retrieve(int $subscriberId): array
    {
        return $this->mapInto(
            $this->client->get("subscribers/$subscriberId/tags"),
            Tag::class
        );
    }

    /**
     * @param SubscriberTagDTO $subscriber
     * @return Tag[]
     */
    public function create(int $subscriberId, SubscriberTagDTO $subscriber): array
    {
        return $this->mapInto(
            $this->client->post(
                "subscribers/$subscriberId/tags",
                (array)$subscriber
            ),
            Tag::class
        );
    }

    /**
     * @param int $subscriberId
     * @param SubscriberTagDTO $subscriber
     * @return Tag[]
     */
    public function update(int $subscriberId, SubscriberTagDTO $subscriber): array
    {
        return $this->mapInto(
            $this->client->put(
                "subscribers/$subscriberId/tags",
                (array)$subscriber
            ), Tag::class
        );
    }

    /**
     * @param int $subscriberId
     * @param SubscriberTagDTO $subscriber
     * @return Tag[]
     */
    public function delete(int $subscriberId, SubscriberTagDTO $subscriber): array
    {
        return $this->mapInto(
            $this->client->delete(
                "subscribers/$subscriberId/tags",
                (array)$subscriber
            ), Tag::class);
    }
}
