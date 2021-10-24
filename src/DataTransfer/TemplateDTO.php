<?php

namespace GamingEngine\SendPortalAPI\DataTransfer;

use Spatie\DataTransferObject\DataTransferObject;

class TemplateDTO extends DataTransferObject
{
    public string $name;

    public string $content;
}
