<?php

namespace Sleekshop\Controller;

use Sleekshop\Helper\SearchHelper;
use Sleekshop\SleekshopRequest;

class CategoriesCtl
{
    private SleekshopRequest $request;

    public function __construct(SleekshopRequest $request) {
        $this->request = $request;
    }

    /**
     * This function returns an array containing all products with the parent defined by $id_category
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
    public function GetProductsInCategory(int $id_category = 0, string $lang = null, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): array
    {
        $lang = $lang ?? $this->request->default_language;
        $json = $this->request->get_products_in_category($id_category, $lang, $order_columns, $order, $left_limit, $right_limit, $needed_attributes);
        if ($json['status'] == 'error') {
            return $json;
        }
        $json['response'] = SearchHelper::process_products_response($json, $this->request);
        return $json;
    }

    /**
     * This function returns an array containing all contents with the parent defined by $id_category
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
    public function GetContentsInCategory(int $id_category = 0, string $lang = null, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): array
    {
        $lang = $lang ?? $this->request->default_language;
        $json = $this->request->get_contents_in_category($id_category, $lang, $order_columns, $order, $left_limit, $right_limit, $needed_attributes);
        if ($json['status'] == 'error') {
            return $json;
        }
        $json['response'] = SearchHelper::process_contents_response($json, $this->request);
        return $json;
    }


    /**
     * This function returns an array containing all categories with the parent defined by $id_parent
     *
     * @param int $id_parent
     * @param string|null $lang
     * @return array
     */
    public function GetCategories(int $id_parent = 0, string $lang = null): array
    {
        $lang = $lang ?? $this->request->default_language;
        $json = $this->request->get_categories($id_parent, $lang);
        if ($json['status'] == 'error') {
            return $json;
        }
        $json['response'] = SearchHelper::process_categories_response($json['response'], $this->request);
        return $json;
    }

    /**
     * This function delivers products and contents recursively from a root category defined by its ID
     *
     * @param int $id_category
     * @param string|null $lang
     * @param string $country
     * @param array $order_columns
     * @param string $order
     * @param int $left_limit
     * @param int $right_limit
     * @param array $needed_attributes
     * @param int $depth
     * @return array
     */
    public function DumpCategory(int $id_category = 0, string $lang = null, $country = '', array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = [], int $depth = 0): array
    {
        return $this->request->dump_category($id_category, $lang, $country, $order_columns, $order, $left_limit, $right_limit, $needed_attributes, $depth);
    }

    /**
     * This function delivers products contained in a category defined by its permalink
     *
     * @param string $permalink
     * @param string|null $country
     * @param array $order_columns
     * @param string $order
     * @param int $left_limit
     * @param int $right_limit
     * @param array $needed_attributes
     * @return array
     */
    public function SeoGetProductsInCategory(string $permalink, string $country = null, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): array
    {
        return $this->request->seo_get_products_in_category($permalink, $country, $order_columns, $order, $left_limit, $right_limit, $needed_attributes);
    }

    /**
     * This function delivers contents contained in a category defined by its permalink
     *
     * @param string $permalink
     * @param array $order_columns
     * @param string $order
     * @param int $left_limit
     * @param int $right_limit
     * @param array $needed_attributes
     * @return array
     */
    public function SeoGetContentsInCategory(string $permalink = '', array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): array
    {
        return $this->request->seo_get_contents_in_category($permalink, $order_columns, $order, $left_limit, $right_limit, $needed_attributes);
    }

    /**
     * This function creates a new category
     *
     * @param int $id_parent
     * @param string $name
     * @param array $labels
     * @param array $attributes
     * @param array $seo
     * @return array
     */
    public function CreateCategory(int $id_parent = 0, string $name = '', array $labels = [], array $attributes = [], array $seo = []): array
    {
        return $this->request->create_category($id_parent, $name, $labels, $attributes, $seo);
    }

    /**
     * This function updates a category
     *
     * @param int $id_category
     * @param string $name
     * @param array $labels
     * @param array $attributes
     * @param array $seo
     * @return array
     */
    public function UpdateCategory(int $id_category = 0, string $name = '', array $labels = [], array $attributes = [], array $seo = []): array
    {
        return $this->request->update_category($id_category, $name, $labels, $attributes, $seo);
    }

    /**
     * This function deletes a category
     *
     * @param int $id_category
     * @return array
     */
    public function DeleteCategory(int $id_category = 0): array
    {
        return $this->request->delete_category($id_category);
    }

}