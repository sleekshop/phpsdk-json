<?php

namespace Sleekshop\Helper;

class CartHelper
{

    /**
     * Converts the cart array into a specific array structure with detailed information.
     *
     * @param array $cart The cart array containing items, coupons, and delivery costs.
     * @return array The transformed cart array with detailed information including items, attributes, and calculated totals.
     */
    public static function get_cart_array(array $cart): array
    {
        $result = array();
        $result["sum"] = (float)$cart['sum'];
        $result["creation_date"] = (string)$cart['creation_date'];
        $result["last_inserted_id"] = isset($cart['last_inserted_element_id']) ? (int)$cart['last_inserted_element_id'] : 0;

        $contents = array();
        foreach ($cart['contents'] as $element) {
            $piece = array();
            $piece["type"] = (string)$element['type'];
            $piece["id"] = (int)$element['id'];
            $piece["id_product"] = (int)$element['id_product'];
            $piece["quantity"] = (float)$element['quantity'];
            $piece["price"] = (float)$element['price'];
            $piece["sum_price"] = (float)$element['sum_price'];
            $piece["name"] = (string)$element['name'];
            $piece["description"] = (string)$element['description'];

            $attributes = array();
            foreach ($element['attributes'] as $attr) {
                $attributes[(string)$attr['name']] = (string)$attr['value'];
            }
            $piece["attributes"] = $attributes;
            $contents[] = $piece;
        }

        $coupons = array();
        $coupons["sum"] = (float)$cart['coupons']['sum'];
        foreach ($cart['coupons']['positions'] as $pos) {
            $piece = array();
            $piece["id"] = 0;
            $piece["id_product"] = 0;
            $piece["quantity"] = 1;
            $piece["price"] = (float)$pos['used_amount'] * -1;
            $piece["sum_price"] = (float)$pos['used_amount'] * -1;
            $piece["name"] = (string)$pos['name'];
            $piece["description"] = " ";
            $contents[] = $piece;
        }

        $delivery_costs = array();
        $delivery_costs["sum"] = (float)$cart['delivery_costs']['sum'];
        foreach ($cart['delivery_costs']['positions'] as $pos) {
            $piece = array();
            $piece["name"] = (string)$pos['name'];
            $piece["price"] = (float)$pos['price'];
            $piece["tax"] = (float)$pos['tax'];
            $delivery_costs[(string)$pos['name']] = $piece;
        }

        $result["contents"] = $contents;
        $result["delivery_costs"] = $delivery_costs;
        $result["sum"] = $result["sum"] - $coupons["sum"];

        return $result;
    }

}