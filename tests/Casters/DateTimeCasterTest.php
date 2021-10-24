<?php

namespace GamingEngine\SendPortalAPI\Tests\Casters;

use DateTime;
use GamingEngine\SendPortalAPI\Casters\DateTimeCaster;
use PHPUnit\Framework\TestCase;

class DateTimeCasterTest extends TestCase
{
    /**
     * @test
     */
    public function date_time_caster_returns_null_if_null_is_provided()
    {
        // Arrange
        $subject = new DateTimeCaster();

        // Act
        $result = $subject->cast(null);

        // Assert
        $this->assertNull($result);
    }

    /**
     * @test
     */
    public function date_time_caster_returns_the_datetime_value()
    {
        // Arrange
        $subject = new DateTimeCaster();

        // Act
        $result = $subject->cast('2021-01-01 05:06:07');

        // Assert
        $this->assertEquals(
            new DateTime('2021-01-01 05:06:07'),
            $result
        );
    }
}
