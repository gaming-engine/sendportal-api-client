<?php

namespace GamingEngine\SendPortalAPI\Clients;

use GamingEngine\SendPortalAPI\DataTransfer\SubscriberDTO;
use GamingEngine\SendPortalAPI\Models\Subscriber\Subscriber;
use GamingEngine\SendPortalAPI\Models\Subscriber\SubscriberDetails;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class SubscriberClient
{
    public function __construct(private ClientInterface $client)
    {
    }

    /**
     * @return Subscriber[]
     * @throws UnknownProperties
     */
    public function retrieve(): array
    {
        return array_map(
            fn($template) => new Subscriber($template),
            $this->client->get('subscribers')
        );
    }

    public function get(int $subscriberId): SubscriberDetails
    {
        return new SubscriberDetails(
            $this->client->get(
                "subscribers/$subscriberId"
            )
        );
    }

    public function create(SubscriberDTO $subscriber): SubscriberDetails
    {
        return new SubscriberDetails(
            $this->client->post(
                'subscribers',
                (array)$subscriber
            )
        );
    }

    public function update(int $subscriberId, SubscriberDTO $subscriber): SubscriberDetails
    {
        return new SubscriberDetails(
            $this->client->put(
                "subscribers/$subscriberId",
                (array)$subscriber
            )
        );
    }

    public function delete(int $subscriberId): void
    {
        $this->client->delete(
            "subscribers/$subscriberId"
        );
    }
}
