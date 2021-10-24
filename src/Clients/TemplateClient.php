<?php

namespace GamingEngine\SendPortalAPI\Clients;

use GamingEngine\SendPortalAPI\DataTransfer\TemplateDTO;
use GamingEngine\SendPortalAPI\Models\Template\Template;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class TemplateClient
{
    public function __construct(private ClientInterface $client)
    {
    }

    /**
     * @return Template[]
     * @throws UnknownProperties
     */
    public function retrieve(): array
    {
        return array_map(
            fn($template) => new Template($template),
            $this->client->get('templates')
        );
    }

    public function get(int $templateId): Template
    {
        return new Template(
            $this->client->get(
                "templates/$templateId"
            )
        );
    }

    public function create(TemplateDTO $template): Template
    {
        return new Template(
            $this->client->post(
                'templates',
                (array)$template
            )
        );
    }

    public function update(int $templateId, TemplateDTO $template): Template
    {
        return new Template(
            $this->client->put(
                "templates/$templateId",
                (array)$template
            )
        );
    }

    public function delete(int $templateId): void
    {
        $this->client->delete(
            "templates/$templateId"
        );
    }
}
