<?php

namespace GamingEngine\SendPortalAPI\Tests\Exceptions;

use GamingEngine\SendPortalAPI\Exceptions\InvalidMethodException;
use PHPUnit\Framework\TestCase;

class InvalidMethodExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function invalid_method_exception_message()
    {
        // Arrange
        $method = 'foo';
        $exception = new InvalidMethodException($method);

        // Act
        $response = $exception->getMessage();

        // Assert
        $this->assertEquals(
            "The specified method, $method, is not valid.",
            $response
        );
    }
}
