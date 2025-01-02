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

    /**
     * Creates a new webhook with the specified name and event.
     *
     * @param string $name The name of the webhook. Defaults to an empty string.
     * @param string $event The event that triggers the webhook. Defaults to an empty string.
     * @return array The response from the webhook creation request.
     */
    public function CreateWebhook(string $name = '', string $event = ''): array
    {
        return $this->request->create_webhook($name, $event);
    }

    /**
     * Updates the webhook with the provided details.
     *
     * @param string $name The name of the webhook to update.
     * @param string $url The new URL for the webhook.
     * @param string $parameter Additional parameter for the webhook.
     *
     * @return array An array containing the response from the webhook update request.
     */
    public function UpdateWebhook(string $name = '', string $url = '', string $parameter = ''): array
    {
        return $this->request->update_webhook($name, $url, $parameter);
    }

}