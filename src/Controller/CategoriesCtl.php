<?php

namespace Sleekshop\Controller;

use Sleekshop\Helper\CategoriesHelper;
use Sleekshop\SleekShopRequest;

class CategoriesCtl
{
    private SleekShopRequest $request;

    public function __construct(SleekShopRequest $request) {
        $this->request = $request;
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
        return CategoriesHelper::process_categories_response($json['response'], $this->request);
    }

    public function GetProductsInCategory(int $id_category = 0, string $lang = null, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): array
    {
        $lang = $lang ?? $this->request->default_language;
        $json = $this->request->get_products_in_category($id_category, $lang, $order_columns, $order, $left_limit, $right_limit, $needed_attributes);
        if ($json['status'] == 'error') {
            return $json;
        }
        return CategoriesHelper::process_products_response($json, $this->request);
    }

    public function GetContentsInCategory(int $id_category = 0, string $lang = null, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): array
    {
        $lang = $lang ?? $this->request->default_language;
        $json = $this->request->get_contents_in_category($id_category, $lang, $order_columns, $order, $left_limit, $right_limit, $needed_attributes);
        if ($json['status'] == 'error') {
            return $json;
        }
        return CategoriesHelper::process_contents_response($json, $this->request);
    }

    public function GetMenu($language = null)
    {
        $language = $language ?? $this->request->default_language;
        if (!file_exists($this->request->template_path . '/cache/' . $language . '-menu.tmp')) {
            $res = CategoriesCtl::GetCategories($this->request->categories_id, $language);
            $res = serialize($res['response']);
            file_put_contents($this->request->template_path . '/cache/' . $language . '-menu.tmp', $res);
        } else {
            $res = file_get_contents($this->request->template_path . '/cache/' . $language . '-menu.tmp');
        }
        return (unserialize($res));
    }


}