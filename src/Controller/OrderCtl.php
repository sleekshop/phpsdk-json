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

    public function SetOrderDetails(string $session = '', array $args = []): array
    {
        return $this->request->set_order_details($session, $args);
    }

    public function GetOrderDetails(string $session = ''): array
    {
        return $this->request->get_order_details($session);
    }

    public function GetOrderById(int $id_order = 0): array
    {
        return $this->request->get_order_by_id($id_order);
    }

    public function UpdateOrderDetails(int $id_order = 0, array $args = []): array
    {
        return $this->request->update_order_details($id_order, $args);
    }

    public function Checkout(string $session = ''): array
    {
        return $this->request->checkout($session);
    }

    public function GetInvoice(int $id_order = 0): array
    {
        return $this->request->get_invoice($id_order);
    }

    public function GetOrderConfirmation(int $id_order = 0, array $args = []): array
    {
        return $this->request->get_order_confirmation($id_order, $args);
    }

    public function GetDeliveryCountries(): array
    {
        return $this->request->get_delivery_countries();
    }

}