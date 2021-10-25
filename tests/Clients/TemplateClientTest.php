<?php

namespace GamingEngine\SendPortalAPI\Tests\Clients;

use GamingEngine\SendPortalAPI\Clients\ApiClientInterface;
use GamingEngine\SendPortalAPI\Clients\TemplateClient;
use GamingEngine\SendPortalAPI\DataTransfer\TemplateDTO;
use GamingEngine\SendPortalAPI\Models\Template\Template;
use PHPUnit\Framework\TestCase;

class TemplateClientTest extends TestCase
{
    /**
     * @test
     */
    public function template_client_retrieve_url()
    {
        // Arrange
        $subject = new TemplateClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $client->expects($this->once())
            ->method('get')
            ->with('templates')
            ->willReturn([]);

        // Act
        $response = $subject->retrieve();

        // Assert
        $this->assertEquals([], $response);
    }

    /**
     * @test
     */
    public function template_client_get_url()
    {
        // Arrange
        $subject = new TemplateClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('get')
            ->with("templates/$number")
            ->willReturn($this->fakeModel());

        // Act
        $response = $subject->get($number);

        // Assert
        $this->assertInstanceOf(Template::class, $response);
    }

    private function fakeModel(): array
    {
        return [
            'id' => 1,
            'name' => 'foo',
            'content' => 'bar',
            'created_at' => '2021-01-01',
            'updated_at' => '2021-01-01',
        ];
    }

    /**
     * @test
     */
    public function template_client_create_url()
    {
        // Arrange
        $subject = new TemplateClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $client->expects($this->once())
            ->method('post')
            ->with('templates')
            ->willReturn($this->fakeModel());

        // Act
        $response = $subject->create($this->createMock(TemplateDTO::class));

        // Assert
        $this->assertInstanceOf(Template::class, $response);
    }

    /**
     * @test
     */
    public function template_client_update_url()
    {
        // Arrange
        $subject = new TemplateClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('put')
            ->with("templates/$number")
            ->willReturn($this->fakeModel());

        // Act
        $response = $subject->update(
            $number,
            $this->createMock(TemplateDTO::class)
        );

        // Assert
        $this->assertInstanceOf(Template::class, $response);
    }

    /**
     * @test
     */
    public function template_client_delete_url()
    {
        // Arrange
        $subject = new TemplateClient(
            $client = $this->createMock(ApiClientInterface::class)
        );

        $number = mt_rand();

        $client->expects($this->once())
            ->method('delete')
            ->with("templates/$number");

        // Act
        $subject->delete($number);
    }
}
