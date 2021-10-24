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
    public function cast(mixed $value): ?DateTime
    {
        if (is_null($value)) {
            return null;
        }

        return new DateTime($value);
    }
}
