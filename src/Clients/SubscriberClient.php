<?php

namespace GamingEngine\SendPortalAPI\Clients;

use GamingEngine\SendPortalAPI\DataTransfer\SubscriberDTO;
use GamingEngine\SendPortalAPI\Models\Subscriber\Subscriber;
use GamingEngine\SendPortalAPI\Models\Subscriber\SubscriberDetails;

class SubscriberClient extends BaseClient
{
    /**
     * @return Subscriber[]
     */
    public function retrieve(): array
    {
        return $this->mapInto(
            $this->client->get('subscribers'),
            Subscriber::class
        );
    }

    public function get(int $subscriberId): SubscriberDetails
    {
        return $this->mapInto(
            $this->client->get("subscribers/$subscriberId"),
            SubscriberDetails::class
        );
    }

    public function create(SubscriberDTO $subscriber): SubscriberDetails
    {
        return $this->mapInto(
            $this->client->post(
                'subscribers',
                (array)$subscriber
            ),
            SubscriberDetails::class
        );
    }

    public function update(int $subscriberId, SubscriberDTO $subscriber): SubscriberDetails
    {
        return $this->mapInto(
            $this->client->put(
                "subscribers/$subscriberId",
                (array)$subscriber
            ), SubscriberDetails::class
        );
    }

    public function delete(int $subscriberId): void
    {
        $this->client->delete(
            "subscribers/$subscriberId"
        );
    }
}
