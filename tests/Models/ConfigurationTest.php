<?php

namespace GamingEngine\SendPortalAPI\Tests\Models;

use GamingEngine\SendPortalAPI\Models\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * @test
     */
    public function configuration_base_uri()
    {
        // Arrange
        $subject = new Configuration(
            $baseUri = md5(time()),
            'token',
        );

        // Act
        $response = $subject->baseUri();

        // Assert
        $this->assertEquals(
            $baseUri,
            $response
        );
    }

    /**
     * @test
     */
    public function configuration_bearer_token()
    {
        // Arrange
        $subject = new Configuration(
            'uri',
            $token = md5(time()),
        );

        // Act
        $response = $subject->bearerToken();

        // Assert
        $this->assertEquals(
            $token,
            $response
        );
    }

    /**
     * @test
     */
    public function configuration_workspace()
    {
        // Arrange
        $subject = new Configuration(
            'uri',
            'token',
            $workspace = mt_rand()
        );

        // Act
        $response = $subject->workspace();

        // Assert
        $this->assertEquals(
            $workspace,
            $response
        );
    }
}
