<?php

namespace GamingEngine\SendPortalAPI\Tests\Clients;

use GamingEngine\SendPortalAPI\Clients\ApiClientInterface;
use GamingEngine\SendPortalAPI\Clients\TagClient;
use GamingEngine\SendPortalAPI\DataTransfer\TagDTO;
use GamingEngine\SendPortalAPI\Models\Tag\Tag;
use PHPUnit\Framework\TestCase;

class TagClientTest extends TestCase
{
    /**
     * @test
     */
    public function tag_client_retrieve_url()
    {
        // Arrange
        $subject = new TagClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $client->expects($this->once())
            ->method('get')
            ->with('tags')
            ->willReturn([]);

        // Act
        $response = $subject->retrieve();

        // Assert
        $this->assertEquals([], $response);
    }

    /**
     * @test
     */
    public function tag_client_get_url()
    {
        // Arrange
        $subject = new TagClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('get')
            ->with("tags/$number")
            ->willReturn($this->fakeModel());

        // Act
        $response = $subject->get($number);

        // Assert
        $this->assertInstanceOf(Tag::class, $response);
    }

    private function fakeModel(): array
    {
        return [
            'id' => 1,
            'name' => 'foo',
            'created_at' => '2021-01-01',
            'updated_at' => '2021-01-01',
        ];
    }

    /**
     * @test
     */
    public function tag_client_create_url()
    {
        // Arrange
        $subject = new TagClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $client->expects($this->once())
            ->method('post')
            ->with('tags')
            ->willReturn($this->fakeModel());

        // Act
        $response = $subject->create($this->createMock(TagDTO::class));

        // Assert
        $this->assertInstanceOf(Tag::class, $response);
    }

    /**
     * @test
     */
    public function tag_client_update_url()
    {
        // Arrange
        $subject = new TagClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('put')
            ->with("tags/$number")
            ->willReturn($this->fakeModel());

        // Act
        $response = $subject->update(
            $number,
            $this->createMock(TagDTO::class)
        );

        // Assert
        $this->assertInstanceOf(Tag::class, $response);
    }

    /**
     * @test
     */
    public function tag_client_delete_url()
    {
        // Arrange
        $subject = new TagClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('delete')
            ->with("tags/$number");

        // Act
        $subject->delete($number);
    }
}
