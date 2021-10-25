<?php

namespace GamingEngine\SendPortalAPI\Tests\Clients;

use GamingEngine\SendPortalAPI\Clients\ApiClient;
use GamingEngine\SendPortalAPI\Http\HttpClientInterface;
use GamingEngine\SendPortalAPI\Models\Configuration;
use PHPUnit\Framework\TestCase;

class ApiClientTest extends TestCase
{
    /**
     * @test
     */
    public function api_client_will_add_the_base_uri()
    {
        // Arrange
        $subject = new ApiClient(
            new Configuration('https://sendportal.site', 'test'),
            $client = $this->createMock(HttpClientInterface::class)
        );

        $client->expects($this->once())
            ->method('get')
            ->with('https://sendportal.site/api/v1/foo')
            ->willReturn([
                'data' => [],
            ]);

        // Act
        $subject->get('foo');

        // Assert
    }

    /**
     * @test
     */
    public function api_client_will_not_duplicate_the_slash_in_the_base_uri()
    {
        // Arrange
        $subject = new ApiClient(
            new Configuration('https://sendportal.site/', 'test'),
            $client = $this->createMock(HttpClientInterface::class)
        );

        $client->expects($this->once())
            ->method('get')
            ->with('https://sendportal.site/api/v1/foo')
            ->willReturn([
                'data' => [],
            ]);

        // Act
        $subject->get('foo');
    }

    /**
     * @test
     */
    public function api_client_will_not_duplicate_the_slash_in_the_base_uri_and_the_uri()
    {
        // Arrange
        $subject = new ApiClient(
            new Configuration('https://sendportal.site/', 'test'),
            $client = $this->createMock(HttpClientInterface::class)
        );

        $client->expects($this->once())
            ->method('get')
            ->with('https://sendportal.site/api/v1/foo')
            ->willReturn([
                'data' => [],
            ]);

        // Act
        $subject->get('/foo');
    }

    /**
     * @test
     */
    public function api_client_will_automatically_add_headers()
    {
        // Arrange
        $subject = new ApiClient(
            new Configuration('https://sendportal.site/', 'test'),
            $client = $this->createMock(HttpClientInterface::class)
        );

        $client->expects($this->once())
            ->method('get')
            ->with($this->anything(), [
                'Authorization' => 'Bearer test',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->willReturn([
                'data' => [],
            ]);

        // Act
        $subject->get('foo');
    }

    /**
     * @test
     */
    public function api_client_post_will_pass_through_data()
    {
        // Arrange
        $subject = new ApiClient(
            new Configuration('https://sendportal.site/', 'test'),
            $client = $this->createMock(HttpClientInterface::class)
        );

        $inputData = [
            'foo' => 'bar',
            'hello' => 'bye',
        ];

        $client->expects($this->once())
            ->method('post')
            ->with($this->anything(), $inputData)
            ->willReturn([
                'data' => [
                    'roar' => 10,
                ],
            ]);

        // Act
        $response = $subject->post('foo', $inputData);

        // Assert
        $this->assertEquals([
            'data' => [
                'roar' => 10,
            ],
        ], $response);
    }

    /**
     * @test
     */
    public function api_client_patch_will_pass_through_data()
    {
        // Arrange
        $subject = new ApiClient(
            new Configuration('https://sendportal.site/', 'test'),
            $client = $this->createMock(HttpClientInterface::class)
        );

        $inputData = [
            'foo' => 'bar',
            'hello' => 'bye',
        ];

        $client->expects($this->once())
            ->method('put')
            ->with($this->anything(), $inputData)
            ->willReturn([
                'data' => [
                    'roar' => 10,
                ],
            ]);

        // Act
        $response = $subject->put('foo', $inputData);

        // Assert
        $this->assertEquals([
            'data' => [
                'roar' => 10,
            ],
        ], $response);
    }

    /**
     * @test
     */
    public function api_client_delete_will_pass_through_the_uri()
    {
        // Arrange
        $subject = new ApiClient(
            new Configuration('https://sendportal.site/', 'test'),
            $client = $this->createMock(HttpClientInterface::class)
        );

        $client->expects($this->once())
            ->method('delete');

        // Act
        $subject->delete('foo');
    }

    /**
     * @test
     */
    public function api_client_get_will_append_the_data()
    {
        // Arrange
        $data = [
            [
                'data' => [
                    [
                        'roar' => 1,
                    ],
                    [
                        'roar' => 2,
                    ]
                ],
                'meta' => [
                    'current_page' => 1,
                    'last_page' => 5,
                    'from' => 1,
                    'path' => 'foo',
                    'per_page' => 20,
                    'to' => 1,
                    'total' => 20,
                ]
            ],
            [
                'data' => [
                    [
                        'roar' => 3,
                    ],
                    [
                        'roar' => 4,
                    ]
                ],
            ],
        ];

        $iteration = 0;
        $subject = new  ApiClient(
            new Configuration('https://sendportal.site/', 'test'),
            $client = $this->createMock(HttpClientInterface::class)
        );

        $client->expects($this->exactly(2))
            ->method('get')
            ->withConsecutive(
                [$this->equalTo('https://sendportal.site/api/v1/foo')],
                [$this->equalTo('https://sendportal.site/api/v1/foo?page=2'),],
            )
            ->willReturnCallback(function () use (&$iteration, $data) {
                return $data[$iteration++];
            });

        // Act
        $response = $subject->get('foo');

        // Assert
        $this->assertEquals(
            [
                [
                    'roar' => 1,
                ],
                [
                    'roar' => 2,
                ],
                [
                    'roar' => 3,
                ],
                [
                    'roar' => 4,
                ],
            ],
            $response
        );
    }
}
