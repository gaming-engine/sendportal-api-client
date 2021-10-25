<?php

namespace GamingEngine\SendPortalAPI\Tests\Clients;

use GamingEngine\SendPortalAPI\Clients\ApiClientInterface;
use GamingEngine\SendPortalAPI\Clients\TagSubscriberClient;
use GamingEngine\SendPortalAPI\DataTransfer\TagSubscriberDTO;
use GamingEngine\SendPortalAPI\Models\Subscriber\Subscriber;
use PHPUnit\Framework\TestCase;

class TagSubscriberClientTest extends TestCase
{
    /**
     * @test
     */
    public function tagSubscriber_client_retrieve_url()
    {
        // Arrange
        $subject = new TagSubscriberClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('get')
            ->with("tags/$number/subscribers")
            ->willReturn([]);

        // Act
        $response = $subject->retrieve($number);

        // Assert
        $this->assertEquals([], $response);
    }

    /**
     * @test
     */
    public function tagSubscriber_client_create_url()
    {
        // Arrange
        $subject = new TagSubscriberClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('post')
            ->with("tags/$number/subscribers")
            ->willReturn([$this->fakeModel()]);

        // Act
        $response = $subject->create($number, $this->createMock(TagSubscriberDTO::class));

        // Assert
        $this->assertTrue(is_array($response));
        $this->assertInstanceOf(Subscriber::class, $response[0]);
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
    public function tagSubscriber_client_update_url()
    {
        // Arrange
        $subject = new TagSubscriberClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('put')
            ->with("tags/$number/subscribers")
            ->willReturn([$this->fakeModel()]);

        // Act
        $response = $subject->update(
            $number,
            $this->createMock(TagSubscriberDTO::class)
        );

        // Assert
        $this->assertTrue(is_array($response));
        $this->assertInstanceOf(Subscriber::class, $response[0]);
    }

    /**
     * @test
     */
    public function tagSubscriber_client_delete_url()
    {
        // Arrange
        $subject = new TagSubscriberClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('delete')
            ->with("tags/$number/subscribers")
            ->willReturn([$this->fakeModel()]);

        // Act
        $subject->delete($number, $this->createMock(TagSubscriberDTO::class));
    }
}
