<?php

namespace GamingEngine\SendPortalAPI\Clients;

use GamingEngine\SendPortalAPI\DataTransfer\TemplateDTO;
use GamingEngine\SendPortalAPI\Models\Template\Template;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class TemplateClient extends BaseClient
{
    /**
     * @return Template[]
     * @throws UnknownProperties
     */
    public function retrieve(): array
    {
        return $this->mapInto(
            $this->client->get('templates'),
            Template::class
        );
    }

    public function get(int $templateId): Template
    {
        return $this->mapInto(
            $this->client->get("templates/$templateId"),
            Template::class
        );
    }

    public function create(TemplateDTO $template): Template
    {
        return $this->mapInto(
            $this->client->post(
                'templates',
                (array)$template
            ),
            Template::class
        );
    }

    public function update(int $templateId, TemplateDTO $template): Template
    {
        return $this->mapInto(
            $this->client->put(
                "templates/$templateId",
                (array)$template
            ),
            Template::class
        );
    }

    public function delete(int $templateId): void
    {
        $this->client->delete("templates/$templateId");
    }
}
