<?php

namespace Sleekshop\Controller;

use Sleekshop\Helper\CartHelper;
use Sleekshop\SleekshopRequest;

class CartCtl
{

    private SleekshopRequest $request;

    public function __construct(SleekshopRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Adds an element to the cart
     *
     * @param string $session
     * @param int $id_product
     * @param int $quantity
     * @param string $price_field
     * @param string $name_field
     * @param string $description_field
     * @param string|null $language
     * @param string $element_type
     * @param int $id_parent_element
     * @param array<object> $attributes
     * @return array
     */
    public function Add(string $session = "", int $id_product = 0, int $quantity = 0, string $price_field = "", string $name_field = "", string $description_field = "", string $language = null, string $element_type = "PRODUCT_GR", int $id_parent_element = 0, array $attributes = []): array
    {
        $json = $this->request->add_to_cart($session, $id_product, $quantity, $price_field, $name_field, $description_field, $language, $element_type, $id_parent_element, $attributes);
        if ($json['status'] !== "success") {
            return $json;
        }
        $json['response'] = CartHelper::get_cart_array($json['response']);
        return $json;
    }

    /**
     * Deletes an element from the cart
     *
     * @param string $session
     * @param int $id_element
     * @return array
     */
    public function Del(string $session = "", int $id_element = 0): array
    {
        $json = $this->request->del_from_cart($session, $id_element);
        if ($json['status'] !== 'success') {
            return $json;
        }
        $json['response'] = CartHelper::get_cart_array($json['response']);
        return $json;
    }

    /**
     * Subtracts an element from the cart
     *
     * @param string $session
     * @param int $id_element
     * @return array
     */
    public function Sub(string $session = "", int $id_element = 0): array
    {
        $json = $this->request->sub_from_cart($session, $id_element);
        if ($json['status'] !== "success") {
            return $json;
        }
        $json['response'] = CartHelper::get_cart_array($json['response']);
        return $json;
    }

    /**
     * Returns the cart of the session
     *
     * @param string $session
     * @return array
     */
    public function Get(string $session = ""): array
    {
        $json = $this->request->get_cart($session);

        if ($json['status'] !== "success") {
            (new SessionCtl($this->request))->InvalidateSession();
            return [];
        }

        $json['response'] = CartHelper::get_cart_array($json['response']);
        return $json;
    }

    /**
     * Clears the cart of the session
     *
     * @param string $session
     * @return array
     */
    public function Clear(string $session = ""): array
    {
        $json = $this->request->clear_cart($session);
        if ($json['status'] !== "success") {
            return $json;
        }

        $json['response'] = CartHelper::get_cart_array($json['response']);
        return $json;
    }

}