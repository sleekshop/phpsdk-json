<?php

namespace Sleekshop\Helper;

use Sleekshop\SleekshopRequest;

class ShopobjectHelper
{
    /**
     * This function returns the availability label for a product
     *
     * @param int $qty
     * @param int $qty_warning
     * @param int $allow_override
     * @param int $active
     * @return string
     */
    public static function get_availability_label(int $qty = 0, int $qty_warning = 0, int $allow_override = 0, int $active = 0): string
    {
        if ($active == 0 or $allow_override == 1) return ('success');
        if ($qty < $qty_warning and $qty > 0) return ('warning');
        if ($qty == 0) return ('danger');
        return ('success');
    }

    /**
     * This function converts a shop object from JSON to an array
     *
     * @param SleekshopRequest $request
     * @param array $so
     * @return array
     */
    public static function get_shopobject_from_json(SleekshopRequest $request, array $so = []): array
    {
        $piecearray = [];
        $piecearray['id'] = (int)$so['id'];
        $piecearray['class'] = (string)$so['class'];
        $piecearray['name'] = (string)$so['name'];
        $piecearray['permalink'] = (string)$so['seo']['permalink'];
        $piecearray['title'] = (string)$so['seo']['title'];
        $piecearray['description'] = (string)$so['seo']['description'];
        $piecearray['keywords'] = (string)$so['seo']['keywords'];

        if (isset($so['availability']['quantity'])) {
            $piecearray['availability_quantity'] = (string)$so['availability']['quantity'];
            $piecearray['availability_quantity_warning'] = (string)$so['availability']['quantity_warning'];
            $piecearray['availability_allow_override'] = (string)$so['availability']['allow_override'];
            $piecearray['availability_active'] = (string)$so['availability']['active'];
            $piecearray['availability_label'] = self::get_availability_label(
                $piecearray['availability_quantity'],
                $piecearray['availability_quantity_warning'],
                $piecearray['availability_allow_override'],
                $piecearray['availability_active']
            );
        }
        $piecearray['creation_date'] = (string)$so['creation_date'];
        $attributes = [];
        foreach ($so['attributes'] as $attribute) {
            $attr = [];
            $attr['type'] = (string)$attribute['type'];
            $attr['id'] = (int)$attribute['id'];
            $attr['name'] = (string)$attribute['name'];
            $attr['label'] = (string)$attribute['label'];
            if ($attr['type'] != 'PRODUCTS') {
                $attr['value'] = (string)$attribute['value'];
                $attr['value'] = htmlspecialchars_decode($attr['value']);
                if ($attr['type'] == 'TXT') {
                    $attr['value'] = str_replace("\n", '<br>', $attr['value']);
                }
            }

            if ($attr['type'] == 'IMG') {
                $width = intval($attribute['width']);
                $height = intval($attribute['height']);
                $factor = 1;
                if ($height != 0) {
                    $factor = $request->product_image_thumb_height / $height;
                }
                $width = intval($width * $factor);
                $height = intval($height * $factor);
                $attr['width'] = $width;
                $attr['height'] = $height;
            }
            if ($attr['type'] == 'PRODUCTS') {
                $prods = $attribute['value'];
                $prods_array = [];
                foreach ($prods as $prod) {
                    $piece = self::get_shopobject_from_json($request, $prod);
                    $prods_array[] = $piece;
                }
                $attr['value'] = $prods_array;
            }
            $attributes[$attribute['name']] = $attr;
        }
        $variations = [];
        foreach ($so['variations'] as $var) {
            $variation = self::get_shopobject_from_json($request, $var);
            $variations[] = $variation;
        }
        $piecearray['attributes'] = $attributes;
        $piecearray['variations'] = $variations;
        return $piecearray;
    }

    /**
     * This function extracts the category details from a JSON array
     *
     * @param array $json
     * @return array
     */
    public static function extract_category_details(array $json): array
    {
        $result = [];
        $result['id_category'] = (int)$json['category']['id'];
        $result['name'] = (string)$json['category']['name'];
        $result['permalink'] = (string)$json['category']['seo']['permalink'];
        $result['title'] = (string)$json['category']['seo']['title'];
        $result['description'] = (string)$json['category']['seo']['description'];
        $result['keywords'] = (string)$json['category']['seo']['keywords'];

        $attributes = [];
        foreach ((array)$json['category']['attributes'] as $attr) {
            $attributes[$attr['name']] = $attr['value'];
        }
        $result['attributes'] = $attributes;

        return $result;
    }

    /**
     * This function returns the products from a JSON array
     *
     * @param SleekshopRequest $request
     * @param array $json
     * @return array
     */
    public static function get_products_from_json(SleekshopRequest $request, array $json = []): array
    {
        $result = [];
        foreach ($json as $so) {
            $result[$so['name']] = self::get_shopobject_from_json($request, $so);
        }
        return $result;
    }

    static function getValueByChainingField($chaining_field, $obj) {
        $current = $obj; // Start with the root object or array
        foreach ($chaining_field as $key) { // Traverse the keys in chaining_field
            if (is_array($current) && array_key_exists($key, $current)) {
                $current = $current[$key]; // Move to the next level
            } else {
                return null; // Return null if a key doesn't exist
            }
        }
        return $current;
    }

    /**
     * This function returns the contents from a JSON array and creates a chain
     *
     * @param SleekshopRequest $request
     * @param array $json
     * @return array
     */
    public static function get_contents_from_json(SleekshopRequest $request, array $json = []): array
    {
        $result = [];
        $prev = 'not_set';
        $current = 'not_set';
        $prevkey = 0;
        $layoutindex = 0;
        $layoutmax = 1;
        $index = 0;
        $result['chain'] = [];

        $obj = [
            "name" => [
                "test" => "123"
            ],
            "test" => "test",
            "lol" => "lol"
        ];

        print_r(self::getValueByChainingField(["name"]["test"], $obj)); // TODO: make this work dynamically
        die();

        foreach ($json as $so) {
            $result[$so['name']] = ShopobjectHelper::get_shopobject_from_json($request, $so);
            $result['byclass'][$so['class']][] = $result[$so['name']];

            if (isset($so['attributes']['layout'])) {
                $current = $so['attributes']['layout']['value'];
                $result['layouts'][$current] = 1;
                $layoutindex = ($current != $prev) ? 0 : $layoutindex + 1;
                $layoutmax = $layoutindex + 1;

                foreach ($result['chain'] as $k => $v) {
                    if ($result['chain'][$k]['index'] > $index - $layoutmax) {
                        $result['chain'][$k]['layoutmax'] = $layoutmax;
                    }
                }

                $result['chain'][$result[$so['name']]['id']] = [
                    'prev' => $prev,
                    'current' => $current,
                    'next' => 'not_set',
                    'index' => $index,
                    'layoutindex' => $layoutindex,
                    'layoutmax' => $layoutmax
                ];

                if ($prevkey > 0) {
                    $result['chain'][$prevkey]['next'] = $current;
                }

                $prevkey = $result[$so['name']]['id'];
                $prev = $current;
                $index++;
            }
        }

        return $result;
    }

    /**
     * This function processes the JSON response and extracts the necessary details
     *
     * @param SleekshopRequest $request
     * @param array $json
     * @return array
     */
    public static function process_shopobjects_response(SleekshopRequest $request, array $json): array
    {
        if ($json['status'] == 'error') {
            return $json;
        }
        $result = self::extract_category_details($json['response']);
        $result['products'] = self::get_products_from_json($request, $json['response']['products']);
        $result['products_count'] = (int)$json['response']['products_count'];
        $result['contents'] = self::get_contents_from_json($request, $json['response']['contents']);
        $result['contents_count'] = (int)$json['response']['contents_count'];

        $json['response'] = $result;
        return $json;
    }
}