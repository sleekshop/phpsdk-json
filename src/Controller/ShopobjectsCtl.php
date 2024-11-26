<?php

namespace Sleekshop\Controller;

use Sleekshop\Helper\ShopobjectHelper;
use Sleekshop\SleekshopRequest;

class ShopobjectsCtl
{

    private SleekshopRequest $request;

    public function __construct(SleekshopRequest $request)
    {
        $this->request = $request;
    }


    /**
     * Delivers an array containing all categories with the parent defined by $id_parent
     *
     * @param int $id_category
     * @param string|null $lang
     * @param array $order_columns
     * @param string $order
     * @param int $left_limit
     * @param int $right_limit
     * @param array $needed_attributes
     * @return array
     */
    public function GetShopobjects(int $id_category = 0, string $lang = null, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): array
    {
        $json = $this->request->get_shopobjects_in_category($id_category, $lang, $order_columns, $order, $left_limit, $right_limit, $needed_attributes);
        if ($json['status'] == 'error') {
            return $json;
        }
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
        if ($json['status'] == 'error') {
            return $json;
        }
        return ShopobjectHelper::process_shopobjects_response($this->request, $json);
    }


    /**
     * This functions returns the product details of a given id
     *
     * @param int $id_product
     * @param string|null $lang
     * @return array
     */
    public function GetProductDetails(int $id_product = 0, string $lang = null): array
    {
        $json = $this->request->get_product_details($id_product, $lang);
        if ($json['status'] == 'error') {
            return $json;
        }
        $json['response'] = ShopobjectHelper::get_shopobject_from_json($this->request, $json['response']);
        return $json;
    }

    /**
     * This function returns the content details of a given id
     *
     * @param int $id_content
     * @param string|null $lang
     * @return array
     */
    public function GetContentDetails(int $id_content = 0, string $lang = null): array
    {
        $json = $this->request->get_content_details($id_content, $lang);
        if ($json['status'] == 'error') {
            return $json;
        }
        $json['response'] = ShopobjectHelper::get_shopobject_from_json($this->request, $json['response']);
        return $json;
    }

    /**
     * This function returns the product details of a given permalink
     *
     * @param string $permalink
     * @param array $needed_attributes
     * @return array
     */
    public function SeoGetProductDetails(string $permalink = "", array $needed_attributes = []): array
    {
        $json = $this->request->seo_get_product_details($permalink, $needed_attributes);
        if ($json['status'] == 'error') {
            return $json;
        }
        $json['response'] = ShopobjectHelper::get_shopobject_from_json($this->request, $json['response']);
        return $json;
    }


    /**
     * This function returns the content details of a given permalink
     *
     * @param string $permalink
     * @return array
     */
    public function SeoGetContentDetails(string $permalink = ''): array
    {
        $json = $this->request->seo_get_content_details($permalink);
        if ($json['status'] == 'error') {
            return $json;
        }
        $json['response'] = ShopobjectHelper::get_shopobject_from_json($this->request, $json['response']);
        return $json;
    }

    /**
     * This function creates a new product
     *
     * @param string $class
     * @param string $name
     * @param int $shop_active
     * @param array $attributes
     * @param array $metadata
     * @param array $seo
     * @param array $availability
     * @return array
     */
    public function CreateProduct(string $class = '', string $name = '', int $shop_active = 0, array $attributes = [], array $metadata = [], array $seo = [], array $availability = []): array
    {
        return $this->request->create_product($class, $name, $shop_active, $attributes, $metadata, $seo, $availability);
    }

    /**
     * This function updates a product
     *
     * @param int $id_product
     * @param string $name
     * @param int $shop_active
     * @param array $attributes
     * @param array $metadata
     * @param array $seo
     * @param array $availability
     * @return array
     */
    public function UpdateProduct(int $id_product = 0, string $name = '', int $shop_active = 0, array $attributes = [], array $metadata = [], array $seo = [], array $availability = []): array
    {
        return $this->request->update_product($id_product, $name, $shop_active, $attributes, $metadata, $seo, $availability);
    }

    /**
     * This function creates a new variation for an existing product
     *
     * @param int $id_product
     * @param string $name
     * @param int $shop_active
     * @param array $attributes
     * @param array $metadata
     * @param array $seo
     * @param array $availability
     * @return array
     */
    public function CreateVariation(int $id_product = 0, string $name = '', int $shop_active = 0, array $attributes = [], array $metadata = [], array $seo = [], array $availability = []): array
    {
        return $this->request->create_variation($id_product, $name, $shop_active, $attributes, $metadata, $seo, $availability);
    }

    /**
     * This function deletes a product
     *
     * @param int $id_product
     * @return array
     */
    public function DeleteProduct(int $id_product = 0): array
    {
        return $this->request->delete_product($id_product);
    }

    /**
     * This function creates a new content
     *
     * @param string $class
     * @param string $name
     * @param int $shop_active
     * @param array $attributes
     * @param array $seo
     * @return array
     */
    public function CreateContent(string $class = '', string $name = '', int $shop_active = 0, array $attributes = [], array $seo = []): array
    {
        return $this->request->create_content($class, $name, $shop_active, $attributes, $seo);
    }

    /**
     * This function updates a content
     *
     * @param int $id_content
     * @param string $name
     * @param int $shop_active
     * @param array $attributes
     * @param array $seo
     * @return array
     */
    public function UpdateContent(int $id_content = 0, string $name = '', int $shop_active = 0, array $attributes = [], array $seo = []): array
    {
        return $this->request->update_content($id_content, $name, $shop_active, $attributes, $seo);
    }

    /**
     * This function deletes a content
     *
     * @param int $id_content
     * @return array
     */
    public function DeleteContent(int $id_content = 0): array
    {
        return $this->request->delete_content($id_content);
    }

}
