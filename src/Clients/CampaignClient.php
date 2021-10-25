<?php

namespace GamingEngine\SendPortalAPI\Clients;

use GamingEngine\SendPortalAPI\DataTransfer\CampaignDTO;
use GamingEngine\SendPortalAPI\Models\Campaign\Campaign;
use GamingEngine\SendPortalAPI\Models\Subscriber\Subscriber;

class CampaignClient extends BaseClient
{
    /**
     * @return Subscriber[]
     */
    public function retrieve(): array
    {
        return $this->mapInto(
            $this->client->get('campaigns'),
            Campaign::class
        );
    }

    public function get(int $campaignId): Campaign
    {
        return $this->mapInto(
            $this->client->get("campaigns/$campaignId"),
            Campaign::class
        );
    }

    public function create(CampaignDTO $campaign): Campaign
    {
        return $this->mapInto(
            $this->client->post(
                'campaigns',
                (array)$campaign
            ),
            Campaign::class
        );
    }

    public function update(int $campaignId, CampaignDTO $campaign): Campaign
    {
        return $this->mapInto(
            $this->client->put(
                "campaigns/$campaignId",
                (array)$campaign
            ), Campaign::class
        );
    }

    public function delete(int $campaignId): void
    {
        $this->client->delete(
            "campaigns/$campaignId"
        );
    }
}
