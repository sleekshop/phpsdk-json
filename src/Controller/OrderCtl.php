<?php

namespace Sleekshop\Controller;

use Sleekshop\SleekshopRequest;

class OrderCtl
{

    private SleekshopRequest $request;

    public function __construct(SleekshopRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Sets the order details for a given session.
     *
     * @param string $session The session identifier.
     * @param array $args The order details to set.
     * @return array The response from the set order
     */
    public function SetOrderDetails(string $session = '', array $args = []): array
    {
        return $this->request->set_order_details($session, $args);
    }

    /**
     * Retrieves the order details for a specified session.
     *
     * @param string $session The session identifier.
     * @return array The details of the order.
     */
    public function GetOrderDetails(string $session = ''): array
    {
        return $this->request->get_order_details($session);
    }

    /**
     * Retrieves the order details by the specified order ID.
     *
     * @param int $id_order The order ID to fetch the details for. Defaults to 0.
     * @return array The details of the specified order.
     */
    public function GetOrderById(int $id_order = 0): array
    {
        return $this->request->get_order_by_id($id_order);
    }

    /**
     * Updates the order details for the specified order ID using provided arguments.
     *
     * @param int $id_order The order ID to update the details for. Defaults to 0.
     * @param array $args The array of arguments with order details to update.
     * @return array The updated details of the specified order.
     */
    public function UpdateOrderDetails(int $id_order = 0, array $args = []): array
    {
        return $this->request->update_order_details($id_order, $args);
    }

    /**
     * Initiates the checkout process using the provided session token.
     *
     * @param string $session The session token for the current user session. Defaults to an empty string if not provided.
     * @return array The response from the checkout request.
     */
    public function Checkout(string $session = ''): array
    {
        return $this->request->checkout($session);
    }

    /**
     * Retrieves the invoice for the specified order ID.
     *
     * @param int $id_order The ID of the order for which the invoice is to be retrieved. Defaults to 0 if not provided.
     * @return array The response containing the invoice details.
     */
    public function GetInvoice(int $id_order = 0): array
    {
        return $this->request->get_invoice($id_order);
    }

    /**
     * Retrieves the order confirmation details for the specified order.
     *
     * @param int $id_order The ID of the order to confirm. Defaults to 0 if not provided.
     * @param array $args Additional arguments for the order confirmation request.
     * @return array The response containing order confirmation details.
     */
    public function GetOrderConfirmation(int $id_order = 0, array $args = []): array
    {
        return $this->request->get_order_confirmation($id_order, $args);
    }

    /**
     * Retrieves a list of available delivery countries.
     *
     * @return array The response containing delivery countries.
     */
    public function GetDeliveryCountries(): array
    {
        return $this->request->get_delivery_countries();
    }

}