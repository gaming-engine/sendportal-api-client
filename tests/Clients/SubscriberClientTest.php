<?php

namespace GamingEngine\SendPortalAPI\Tests\Clients;

use GamingEngine\SendPortalAPI\Clients\ApiClientInterface;
use GamingEngine\SendPortalAPI\Clients\SubscriberClient;
use GamingEngine\SendPortalAPI\DataTransfer\SubscriberDTO;
use GamingEngine\SendPortalAPI\Models\Subscriber\Subscriber;
use PHPUnit\Framework\TestCase;

class SubscriberClientTest extends TestCase
{
    /**
     * @test
     */
    public function subscriber_client_retrieve_url()
    {
        // Arrange
        $subject = new SubscriberClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $client->expects($this->once())
            ->method('get')
            ->with('subscribers')
            ->willReturn([]);

        // Act
        $response = $subject->retrieve();

        // Assert
        $this->assertEquals([], $response);
    }

    /**
     * @test
     */
    public function subscriber_client_get_url()
    {
        // Arrange
        $subject = new SubscriberClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('get')
            ->with("subscribers/$number")
            ->willReturn($this->fakeModel());

        // Act
        $response = $subject->get($number);

        // Assert
        $this->assertInstanceOf(Subscriber::class, $response);
    }

    private function fakeModel(): array
    {
        return [
            'id' => 1,
            'first_name' => 'foo',
            'last_name' => 'bar',
            'email' => 'foo@foo.com',
            'tags' => [],
            'unsubscribed_at' => '2021-01-01',
            'created_at' => '2021-01-01',
            'updated_at' => '2021-01-01',
        ];
    }

    /**
     * @test
     */
    public function subscriber_client_create_url()
    {
        // Arrange
        $subject = new SubscriberClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $client->expects($this->once())
            ->method('post')
            ->with('subscribers')
            ->willReturn($this->fakeModel());

        // Act
        $response = $subject->create(
            $this->createMock(SubscriberDTO::class)
        );

        // Assert
        $this->assertInstanceOf(Subscriber::class, $response);
    }

    /**
     * @test
     */
    public function subscriber_client_update_url()
    {
        // Arrange
        $subject = new SubscriberClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('put')
            ->with("subscribers/$number")
            ->willReturn($this->fakeModel());

        // Act
        $response = $subject->update(
            $number,
            $this->createMock(SubscriberDTO::class)
        );

        // Assert
        $this->assertInstanceOf(Subscriber::class, $response);
    }

    /**
     * @test
     */
    public function subscriber_client_delete_url()
    {
        // Arrange
        $subject = new SubscriberClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('delete')
            ->with("subscribers/$number");

        // Act
        $subject->delete($number);
    }
}
