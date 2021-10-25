<?php

namespace GamingEngine\SendPortalAPI\Tests\Clients;

use GamingEngine\SendPortalAPI\Clients\ApiClientInterface;
use GamingEngine\SendPortalAPI\Clients\SubscriberTagClient;
use GamingEngine\SendPortalAPI\DataTransfer\SubscriberTagDTO;
use GamingEngine\SendPortalAPI\Models\Tag\Tag;
use PHPUnit\Framework\TestCase;

class SubscriberTagClientTest extends TestCase
{
    /**
     * @test
     */
    public function subscriberTag_client_retrieve_url()
    {
        // Arrange
        $subject = new SubscriberTagClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('get')
            ->with("subscribers/$number/tags")
            ->willReturn([]);

        // Act
        $response = $subject->retrieve($number);

        // Assert
        $this->assertEquals([], $response);
    }

    /**
     * @test
     */
    public function subscriberTag_client_create_url()
    {
        // Arrange
        $subject = new SubscriberTagClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('post')
            ->with("subscribers/$number/tags")
            ->willReturn([$this->fakeModel()]);

        // Act
        $response = $subject->create($number, $this->createMock(SubscriberTagDTO::class));

        // Assert
        $this->assertTrue(is_array($response));
        $this->assertInstanceOf(Tag::class, $response[0]);
    }

    private function fakeModel(): array
    {
        return [
            'id' => 1,
            'name' => 'foo',
            'content' => 'bar',
            'scheduled_at' => '2021-01-01',
            'created_at' => '2021-01-01',
            'updated_at' => '2021-01-01',
        ];
    }

    /**
     * @test
     */
    public function subscriberTag_client_update_url()
    {
        // Arrange
        $subject = new SubscriberTagClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('put')
            ->with("subscribers/$number/tags")
            ->willReturn([$this->fakeModel()]);

        // Act
        $response = $subject->update(
            $number,
            $this->createMock(SubscriberTagDTO::class)
        );

        // Assert
        $this->assertTrue(is_array($response));
        $this->assertInstanceOf(Tag::class, $response[0]);
    }

    /**
     * @test
     */
    public function subscriberTag_client_delete_url()
    {
        // Arrange
        $subject = new SubscriberTagClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('delete')
            ->with("subscribers/$number/tags")
            ->willReturn([$this->fakeModel()]);

        // Act
        $subject->delete($number, $this->createMock(SubscriberTagDTO::class));
    }
}
