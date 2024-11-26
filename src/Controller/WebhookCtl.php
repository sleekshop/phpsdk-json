<?php

namespace Sleekshop\Controller;

use Sleekshop\SleekshopRequest;

class WebhookCtl
{

    private SleekshopRequest $request;

    public function __construct(SleekshopRequest $request)
    {
        $this->request = $request;
    }

    public function CreateWebhook(string $name = '', string $event = ''): array
    {
        return $this->request->create_webhook($name, $event);
    }

    public function UpdateWebhook(string $name = '', string $url = '', string $parameter = ''): array
    {
        return $this->request->update_webhook($name, $url, $parameter);
    }

}