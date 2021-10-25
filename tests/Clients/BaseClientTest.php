<?php

namespace GamingEngine\SendPortalAPI\Tests\Clients;

use GamingEngine\SendPortalAPI\Clients\ApiClientInterface;
use GamingEngine\SendPortalAPI\DataTransfer\SubscriberTagDTO;
use PHPUnit\Framework\TestCase;

class BaseClientTest extends TestCase
{
    /**
     * @test
     */
    public function base_client_map_into_will_return_an_empty_array_if_no_data_is_provided()
    {
        // Arrange
        $subject = new SampleClient(
            $this->createMock(ApiClientInterface::class)
        );

        // Act
        $response = $subject->get([], 'foo');

        // Assert
        $this->assertEquals([], $response);
    }

    /**
     * @test
     */
    public function base_client_map_into_will_load_data_into_the_specified_class()
    {
        // Arrange
        $subject = new SampleClient(
            $this->createMock(ApiClientInterface::class)
        );

        // Act
        $response = $subject->get([
            'tags' => [1, 2]
        ], SubscriberTagDTO::class);

        // Assert
        $this->assertInstanceOf(SubscriberTagDTO::class, $response);
        $this->assertEquals([1, 2], $response->tags);
    }

    /**
     * @test
     */
    public function base_client_map_into_will_load_arrays_of_data_into_an_array()
    {
        // Arrange
        $subject = new SampleClient(
            $this->createMock(ApiClientInterface::class)
        );

        // Act
        $response = $subject->get([
            [
                'tags' => [1, 2]
            ],
            [
                'tags' => [3, 4]
            ]
        ], SubscriberTagDTO::class);

        // Assert
        $this->assertTrue(is_array($response));
        $this->assertEquals([1, 2], $response[0]->tags);
        $this->assertEquals([3, 4], $response[1]->tags);
    }
}
