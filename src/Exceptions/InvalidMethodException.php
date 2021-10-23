<?php

namespace GamingEngine\SendPortalAPI\Exceptions;

class InvalidMethodException extends \Exception
{
    public function __construct(string $method)
    {
        parent::__construct("The specified method, $method, is not valid.");
    }
}
