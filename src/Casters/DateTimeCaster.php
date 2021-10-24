<?php

namespace GamingEngine\SendPortalAPI\Casters;

use DateTime;
use Spatie\DataTransferObject\Caster;

class DateTimeCaster implements Caster
{
    /**
     * @param array|mixed $value
     *
     * @return mixed
     */
    public function cast(mixed $value): DateTime
    {
        return new DateTime($value);
    }
}
