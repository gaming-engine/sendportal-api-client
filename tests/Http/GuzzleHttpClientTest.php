<?php

namespace GamingEngine\SendPortalAPI\Tests\Http;

use GamingEngine\SendPortalAPI\Http\GuzzleHttpClient;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class GuzzleHttpClientTest extends TestCase
{
    /**
     * @test
     */
    public function guzzle_http_client_defaults_the_content_type()
    {
        // Arrange

        // Act
        $subject = new GuzzleHttpClient(
            $this->createMock(Client::class)
        );

        // Assert
        $this->assertEquals([
            'Content-Type' => 'application/json',
        ], $subject->getHeaders());
    }

    /**
     * @test
     */
    public function guzzle_http_client_set_header_adds_a_header()
    {
        // Arrange
        $subject = new GuzzleHttpClient(
            $this->createMock(Client::class)
        );

        // Act
        $subject->setHeader('foo', 'bar');

        // Assert
        $this->assertEquals([
            'Content-Type' => 'application/json',
            'foo' => 'bar',
        ], $subject->getHeaders());
    }

    /**
     * @test
     */
    public function guzzle_http_client_set_headers_adds_multiple_headers()
    {
        // Arrange
        $subject = new GuzzleHttpClient(
            $this->createMock(Client::class)
        );

        $data = [
            'foo' => 'bar',
            'testing' => mt_rand(),
        ];

        // Act
        $subject->setHeaders($data);

        // Assert
        $this->assertEquals(array_merge([
            'Content-Type' => 'application/json',
        ], $data), $subject->getHeaders());
    }

    /**
     * @test
     */
    public function guzzle_http_client_get_will_retrieve_the_data()
    {
        // Arrange
        $subject = new GuzzleHttpClient(
            $client = $this->createMock(Client::class)
        );

        $data = (object)[
            'foo' => 'bar',
        ];

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')
            ->willReturn(json_encode($data));

        $client->method('request')
            ->willReturn($response);

        // Act
        $response = $subject->get('url');

        // Assert
        $this->assertEquals($data, $response);
    }

    /**
     * @test
     */
    public function guzzle_http_client_post_will_retrieve_data()
    {
        // Arrange
        $subject = new GuzzleHttpClient(
            $client = $this->createMock(Client::class)
        );

        $data = (object)[
            'foo' => 'bar',
        ];

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')
            ->willReturn(json_encode($data));

        $client->method('request')
            ->willReturn($response);

        // Act
        $response = $subject->post('url', [
            'data' => 'other'
        ]);

        // Assert
        $this->assertEquals($data, $response);
    }

    /**
     * @test
     */
    public function guzzle_http_client_post_will_send_the_data_through()
    {
        // Arrange
        $subject = new GuzzleHttpClient(
            $client = $this->createMock(Client::class)
        );

        $data = (object)[
            'foo' => 'bar',
        ];

        $postedData = [
            'test' => mt_rand(),
        ];

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')
            ->willReturn(json_encode($data));

        $client->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                'url',
                $this->callback(fn($value) => $postedData === $value['json'])
            )
            ->willReturn($response);

        // Act
        $response = $subject->post('url', $postedData);

        // Assert
        $this->assertEquals($data, $response);
    }

    /**
     * @test
     */
    public function guzzle_http_client_put_will_send_the_data_through()
    {
        // Arrange
        $subject = new GuzzleHttpClient(
            $client = $this->createMock(Client::class)
        );

        $data = (object)[
            'foo' => 'bar',
        ];

        $postedData = [
            'test' => mt_rand(),
        ];

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')
            ->willReturn(json_encode($data));

        $client->expects($this->once())
            ->method('request')
            ->with(
                'PUT',
                'url',
                $this->callback(fn($value) => $postedData === $value['json'])
            )
            ->willReturn($response);

        // Act
        $response = $subject->put('url', $postedData);

        // Assert
        $this->assertEquals($data, $response);
    }

    /**
     * @test
     */
    public function guzzle_http_client_delete_will_send_the_request()
    {
        // Arrange
        $subject = new GuzzleHttpClient(
            $client = $this->createMock(Client::class)
        );

        $data = (object)[
            'foo' => 'bar',
        ];

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')
            ->willReturn(json_encode($data));

        $client->expects($this->once())
            ->method('request')
            ->with('DELETE', 'url')
            ->willReturn($response);

        // Act
        $subject->delete('url');

        // Assert
    }
}
