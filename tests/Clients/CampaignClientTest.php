<?php

namespace GamingEngine\SendPortalAPI\Tests\Clients;

use GamingEngine\SendPortalAPI\Clients\ApiClientInterface;
use GamingEngine\SendPortalAPI\Clients\CampaignClient;
use GamingEngine\SendPortalAPI\DataTransfer\CampaignDTO;
use GamingEngine\SendPortalAPI\Models\Campaign\Campaign;
use PHPUnit\Framework\TestCase;

class CampaignClientTest extends TestCase
{
    /**
     * @test
     */
    public function campaign_client_retrieve_url()
    {
        // Arrange
        $subject = new CampaignClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $client->expects($this->once())
            ->method('get')
            ->with('campaigns')
            ->willReturn([]);

        // Act
        $response = $subject->retrieve();

        // Assert
        $this->assertEquals([], $response);
    }

    /**
     * @test
     */
    public function campaign_client_get_url()
    {
        // Arrange
        $subject = new CampaignClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('get')
            ->with("campaigns/$number")
            ->willReturn($this->fakeModel());

        // Act
        $response = $subject->get($number);

        // Assert
        $this->assertInstanceOf(Campaign::class, $response);
    }

    private function fakeModel(): array
    {
        return [
            'id' => 1,
            'name' => 'foo',
            'content' => 'bar',
            'status_id' => 2,
            'template_id' => 3,
            'email_service_id' => 4,
            'from_name' => 'testing',
            'from_email' => 'foo@foo.com',
            'is_open_tracking' => true,
            'is_click_tracking' => false,
            'sent_count' => 10,
            'open_count' => 12,
            'click_count' => 14,
            'send_to_all' => true,
            'tags' => [],
            'save_as_draft' => true,
            'scheduled_at' => '2021-01-01',
            'created_at' => '2021-01-01',
            'updated_at' => '2021-01-01',
        ];
    }

    /**
     * @test
     */
    public function campaign_client_create_url()
    {
        // Arrange
        $subject = new CampaignClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $client->expects($this->once())
            ->method('post')
            ->with('campaigns')
            ->willReturn($this->fakeModel());

        // Act
        $response = $subject->create($this->createMock(CampaignDTO::class));

        // Assert
        $this->assertInstanceOf(Campaign::class, $response);
    }

    /**
     * @test
     */
    public function campaign_client_update_url()
    {
        // Arrange
        $subject = new CampaignClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('put')
            ->with("campaigns/$number")
            ->willReturn($this->fakeModel());

        // Act
        $response = $subject->update(
            $number,
            $this->createMock(CampaignDTO::class)
        );

        // Assert
        $this->assertInstanceOf(Campaign::class, $response);
    }

    /**
     * @test
     */
    public function campaign_client_delete_url()
    {
        // Arrange
        $subject = new CampaignClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('delete')
            ->with("campaigns/$number");

        // Act
        $subject->delete($number);
    }
}
