<?php

namespace GamingEngine\SendPortalAPI\Tests\Models\Http;

use GamingEngine\SendPortalAPI\Models\Http\PaginatedResponse;
use PHPUnit\Framework\TestCase;

class PaginatedResponseTest extends TestCase
{
    /**
     * @test
     */
    public function paginated_response_says_there_is_no_more_pages_if_there_is_no_metadata()
    {
        // Arrange
        $subject = new PaginatedResponse([
            'data' => []
        ]);

        // Act
        $result = $subject->hasNextPage();

        // Assert
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function paginated_response_says_there_are_pages_if_the_metadata_dictates_it()
    {
        // Arrange
        $subject = new PaginatedResponse([
            'data' => [],
            'meta' => [
                'current_page' => 1,
                'last_page' => 5,
                'from' => 1,
                'path' => 'foo',
                'per_page' => 20,
                'to' => 1,
                'total' => 20,
            ]
        ]);

        // Act
        $result = $subject->hasNextPage();

        // Assert
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function paginated_response_says_there_are_no_pages_if_the_metadata_says_there_is_not()
    {
        // Arrange
        $subject = new PaginatedResponse([
            'data' => [],
            'meta' => [
                'current_page' => 5,
                'last_page' => 5,
                'from' => 1,
                'path' => 'foo',
                'per_page' => 20,
                'to' => 1,
                'total' => 20,
            ]
        ]);

        // Act
        $result = $subject->hasNextPage();

        // Assert
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function paginated_response_current_page_is_1_if_there_is_no_metadata()
    {
        // Arrange
        $subject = new PaginatedResponse([
            'data' => []
        ]);

        // Act
        $result = $subject->currentPage();

        // Assert
        $this->assertEquals(
            1,
            $result
        );
    }

    /**
     * @test
     */
    public function paginated_response_current_page_is_retrieved_from_metadata()
    {
        // Arrange
        $subject = new PaginatedResponse([
            'data' => [],
            'meta' => [
                'current_page' => 5,
                'last_page' => 5,
                'from' => 1,
                'path' => 'foo',
                'per_page' => 20,
                'to' => 1,
                'total' => 20,
            ]
        ]);

        // Act
        $result = $subject->currentPage();

        // Assert
        $this->assertEquals(5, $result);
    }
}
