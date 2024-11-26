<?php

namespace Sleekshop\Helper;

use Sleekshop\SleekshopRequest;

class CategoriesHelper
{
    /**
     * Processes the JSON response and extracts the necessary details for categories.
     *
     * @param array $json
     * @param SleekshopRequest $request
     * @return array
     */
    public static function process_categories_response(array $json, SleekshopRequest $request): array
    {
        $result = [];
        foreach ($json['categories'] as $shopCategory) {
            $categoryDetails = [
                'id' => (int)$shopCategory['id'],
                'label' => (string)$shopCategory['label'],
                'name' => (string)$shopCategory['name'],
                'permalink' => (string)$shopCategory['seo']['permalink'],
                'title' => (string)$shopCategory['seo']['title'],
                'description' => (string)$shopCategory['seo']['description'],
                'keywords' => (string)$shopCategory['seo']['keywords'],
                'attributes' => array_column($shopCategory['attributes'], 'value', 'name'),
                'link' => $shopCategory['attributes']['link']['value'] ?? '',
                'position' => $shopCategory['attributes']['position']['value'] ?? '',
                'children' => self::process_categories_response(
                    $request->get_categories($shopCategory['id'])['response'],
                    $request
                ),
            ];
            $result[] = $categoryDetails;
        }
        return $result;
    }

    /**
     * Processes the JSON response and extracts the necessary details for products.
     *
     * @param array $json The JSON response containing product data.
     * @param SleekshopRequest $request The SleekshopRequest object used for making requests.
     * @return array The processed product details.
     */
    public static function process_products_response(array $json, SleekshopRequest $request): array
    {
        if ($json['status'] == 'error') {
            return $json;
        }
        $result = ShopobjectHelper::extract_category_details($json['response']);
        $result['products'] = ShopobjectHelper::get_products_from_json($request, $json['response']['products']);
        $result['products_count'] = (int)$json['response']['count'];
        return $result;
    }

    /**
     * Processes the JSON response and extracts the necessary details for contents.
     *
     * @param array $json The JSON response received from the API call.
     * @param SleekshopRequest $request The request object used to make additional API calls if necessary.
     * @return array The extracted content details along with the count of contents.
     */
    public static function process_contents_response(array $json, SleekshopRequest $request): array
    {
        if ($json['status'] == 'error') {
            return $json;
        }
        $result = ShopobjectHelper::extract_category_details($json['response']);
        $result['contents'] = ShopobjectHelper::get_contents_from_json($request, $json['response']['contents']);
        $result['contents_count'] = (int)$json['response']['count'];
        return $result;
    }
}