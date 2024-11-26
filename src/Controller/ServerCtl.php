<?php

namespace Sleekshop\Controller;

use Sleekshop\SleekshopRequest;

class ServerCtl
{

    private SleekshopRequest $request;

    public function __construct(SleekshopRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Retrieves the current status from the sleekshop instance.
     *
     * @return array The status information as an associative array.
     */
    public function GetStatus(): array
    {
        return $this->request->get_status();
    }

    /**
     * Creates a new channel with the given parameters.
     *
     * @param string $name The name of the channel.
     * @param string $description A brief description of the channel.
     * @param int $shop_active Indicates whether the channel is active (1 for active, 0 for inactive).
     * @param string $server_output The format for the server output, default is 'json', deprecated but still maintained is 'xml'.
     * @return array The response from the server regarding the channel creation.
     */
    public function CreateChannel(string $name = '', string $description = '', int $shop_active = 0, string $server_output = 'json'): array
    {
        return $this->request->create_channel($name, $description, $shop_active, $server_output);
    }

}