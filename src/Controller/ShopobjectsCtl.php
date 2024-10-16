<?php

namespace Sleekshop\Controller;

use Sleekshop\Helper\ShopobjectHelper;
use Sleekshop\SleekShopRequest;

class ShopobjectsCtl
{

    private SleekShopRequest $request;

    public function __construct(SleekShopRequest $request)
    {
        $this->request = $request;
    }


    /*
     * Delivers an array containing all categories with the parent defined by $id_parent
     */
    public function GetShopobjects($id_category = 0, $lang = null, $order_columns = [], $order = 'ASC', $left_limit = 0, $right_limit = 0, $needed_attributes = []): array
    {
        $json = $this->request->get_shopobjects_in_category($id_category, $lang, $order_columns, $order, $left_limit, $right_limit, $needed_attributes);
        return ShopobjectHelper::process_shopobjects_response($this->request, $json);
    }

    /**
     * This function returns the shopobjects of a given category by its permalink
     *
     * @param string $permalink
     * @param array $order_columns
     * @param string $order
     * @param int $left_limit
     * @param int $right_limit
     * @param array $needed_attributes
     * @return array
     */
    public function SeoGetShopobjects(string $permalink, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): array
    {
        $json = $this->request->seo_get_shopobjects_in_category($permalink, $order_columns, $order, $left_limit, $right_limit, $needed_attributes);
        return ShopobjectHelper::process_shopobjects_response($this->request, $json);
    }


    /**
     * This functions returns
     *
     * @param $id_product
     * @param $lang
     * @return array
     */
    public function GetProductDetails($id_product = 0, $lang = null)
    {
        $json = $this->request->get_product_details($id_product, $lang);
        return ShopobjectHelper::get_shopobject_from_json($this->request, $json);
    }


    /*
     * Delivers the shopobject - details of a given shopobject determined by its id
    */
    public static function GetContentDetails($id_content = 0, $lang = DEFAULT_LANGUAGE)
    {
        $sr = new SleekShopRequest();
        $json = $sr->get_content_details($id_content, $lang);
        $json = json_decode($json);
        $result = self::get_shopobject_from_json($json);
        return ($result);
    }


    /*
     * Delivers Shopobject - Details given a permalink
     */
    public static function SeoGetProductDetails($permalink = '')
    {
        $sr = new SleekShopRequest();
        $json = $sr->seo_get_product_details($permalink);
        $json = json_decode($json);
        $result = self::get_shopobject_from_json($json);
        return ($result);
    }


    /*
     * Delivers Shopobject - Details given a permalink
    */
    public static function SeoGetContentDetails($permalink = '')
    {
        $sr = new SleekShopRequest();
        $json = $sr->seo_get_content_details($permalink);
        $json = json_decode($json);
        if (isset($json->object) && $json->object == 'error') {
            $result = null;
        } else {
            $result = self::get_shopobject_from_json($json);
        }
        return ($result);
    }


    /*
     * Search
    */
    public static function SearchProducts($constraint = [], $left_limit = 0, $right_limit = 0, $order_columns = [], $order_type = 'ASC', $lang = DEFAULT_LANGUAGE, $needed_attributes = [])
    {
        $sr = new SleekShopRequest();
        $json = $sr->search_products($constraint, $left_limit, $right_limit, $order_columns, $order_type, $lang, $needed_attributes);
        $json = json_decode($json);
        $result['products'] = self::get_products_from_json($json->result);
        $result['count'] = (int)$json->count;
        return ($result);
    }


}
