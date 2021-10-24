<?php

namespace GamingEngine\SendPortalAPI\Tests\Models\Http;

use GamingEngine\SendPortalAPI\Models\Http\Metadata;
use PHPUnit\Framework\TestCase;

class MetadataTest extends TestCase
{
    /**
     * @test
     */
    public function metadata_determines_when_there_are_more_pages()
    {
        // Arrange
        $subject = new Metadata([
            'current_page' => 1,
            'last_page' => 5,
            'from' => 1,
            'path' => 'foo',
            'per_page' => 20,
            'to' => 1,
            'total' => 20,
        ]);

        // Act
        $result = $subject->hasNextPage();

        // Assert
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function metadata_determines_when_there_are_no_more_pages()
    {
        // Arrange
        $subject = new Metadata([
            'current_page' => 5,
            'last_page' => 5,
            'from' => 1,
            'path' => 'foo',
            'per_page' => 20,
            'to' => 1,
            'total' => 20,
        ]);

        // Act
        $result = $subject->hasNextPage();

        // Assert
        $this->assertFalse($result);
    }
}
