<?php

namespace Sleekshop\Controller;

use Sleekshop\SleekshopRequest;

class PaymentCtl
{

    private SleekshopRequest $request;

    public function __construct(SleekshopRequest $request)
    {
        $this->request = $request;
    }

    /**
     * This function returns an array containing all payment methods configured in the sleekshop backend
     *
     * @return array
     */
    public function GetPaymentMethods(): array
    {
        $json = $this->request->get_payment_methods();
        if ($json['status'] == 'error') {
            return $json;
        }
        $result = [];
        foreach ($json['response'] as $method) {
            if ($method != 'payment_methods') {
                $piecearray = array();
                $piecearray['id'] = (int)$method['id'];
                $piecearray['name'] = (string)$method['name'];
                foreach ((array)$method['attributes'] as $key => $attr) {
                    $piecearray['attributes'][$key] = (string)$attr;
                }
                $result[(string)$method['name']] = $piecearray;
            }
        }
        return ($result);
    }

    /**
     * This function initializes the payment for the payment provider via sleekshop
     *
     * @param int $id_order
     * @param array $args
     * @return array|string[]
     */
    public function DoPayment(int $id_order = 0, array $args = [])
    {
        $json = $this->request->do_payment($id_order, $args);
        if ($json['status'] == 'error') {
            return $json;
        }
        $result = [];
        $result["method"] = (string)$json['method'];
        $result["status"] = (string)$json['status'];
        $result["redirect"] = html_entity_decode((string)($json['redirect']));
        $result["token"] = $json['token'];

        $json['response'] = $result;
        return $json;
    }

    /**
     * This function adds the delivery costs to the order
     *
     * @param string $session
     * @param array $delivery_costs
     * @return array|string[]
     */
    public function AddDeliveryCosts(string $session = "", array $delivery_costs = [])
    {
        return $this->request->add_delivery_costs($session, $delivery_costs);
    }


}