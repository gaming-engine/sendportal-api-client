<?php

namespace GamingEngine\SendPortalAPI\Tests\Models;

use GamingEngine\SendPortalAPI\Exceptions\InvalidMethodException;
use GamingEngine\SendPortalAPI\Models\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    /**
     * @test
     */
    public function request_set_method_allows_setting_as_post()
    {
        // Arrange
        $subject = new Request();

        // Act
        $subject->setMethod('post');

        // Assert
        $this->assertEquals(
            'POST',
            $subject->method()
        );
    }

    /**
     * @test
     */
    public function request_set_method_allows_setting_as_get()
    {
        // Arrange
        $subject = new Request();

        // Act
        $subject->setMethod('get');

        // Assert
        $this->assertEquals(
            'GET',
            $subject->method()
        );
    }

    /**
     * @test
     */
    public function request_set_method_allows_setting_as_put()
    {
        // Arrange
        $subject = new Request();

        // Act
        $subject->setMethod('put');

        // Assert
        $this->assertEquals(
            'PUT',
            $subject->method()
        );
    }

    /**
     * @test
     */
    public function request_set_method_allows_setting_as_delete()
    {
        // Arrange
        $subject = new Request();

        // Act
        $subject->setMethod('delete');

        // Assert
        $this->assertEquals(
            'DELETE',
            $subject->method()
        );
    }

    /**
     * @test
     */
    public function request_set_method_throws_an_exception_when_other_methods_are_used()
    {
        // Arrange
        $subject = new Request();

        $this->expectException(InvalidMethodException::class);

        // Act
        $subject->setMethod('options');

        // Assert
    }

    /**
     * @test
     */
    public function request_set_uri_will_save_the_uri_provided()
    {
        // Arrange
        $subject = new Request();

        // Act
        $subject->setUri('https://google.com');

        // Assert
        $this->assertEquals(
            'https://google.com',
            $subject->uri()
        );
    }

    /**
     * @test
     */
    public function request_set_data_will_maintain_the_data()
    {
        // Arrange
        $subject = new Request();
        $data = [
            'foo' => 'bar',
        ];

        // Act
        $subject->setData($data);

        // Assert
        $this->assertEquals(
            $data,
            $subject->data()
        );
    }

    /**
     * @test
     */
    public function request_set_headers_will_maintain_the_data()
    {
        // Arrange
        $subject = new Request();
        $headers = [
            'foo' => 'bar',
        ];

        // Act
        $subject->setHeaders($headers);

        // Assert
        $this->assertEquals(
            $headers,
            $subject->headers()
        );
    }
}
