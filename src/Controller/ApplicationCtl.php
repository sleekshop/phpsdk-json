<?php

namespace Sleekshop\Controller;

use Sleekshop\SleekshopRequest;

class ApplicationCtl
{

    private SleekshopRequest $request;

    public function __construct(SleekshopRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Make an API call to a specified application.
     *
     * @param string $application The name of the application targeted by the API call.
     * @param string $app_request The specific request or endpoint within the application.
     * @param array $args Additional arguments or parameters for the API call.
     * @return array The response from the API call.
     */
    public function ApplicationApiCall(string $application = "", string $app_request = "", array $args = []): array
    {
        return $this->request->application_api_call($application, $app_request, $args);
    }

}