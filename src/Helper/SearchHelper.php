<?php

namespace Sleekshop\Helper;

use Sleekshop\SleekshopRequest;

class SearchHelper
{

    /**
     * This function converts the product search result
     *
     * @param SleekshopRequest $request
     * @param array $json
     * @return array
     */
    public static function convert_product_search_result(SleekshopRequest $request, array $json = []): array
    {
        $result = [];
        $result['count'] = (int)$json['count'];
        foreach ($json['result'] as $so) {
            $result['products'][$so['name']] = ShopobjectHelper::get_shopobject_from_json($request, $so);
        }
        return $result;
    }

    /**
     * This function converts the content search result
     *
     * @param SleekshopRequest $request
     * @param array $json
     * @return array
     */
    public static function convert_content_search_result(SleekshopRequest $request, array $json = []): array
    {
        $result = [];
        $result['count'] = (int)$json['count'];
        foreach ($json['result'] as $so) {
            $result['contents'][$so['name']] = ShopobjectHelper::get_shopobject_from_json($request, $so);
        }
        return $result;
    }

}