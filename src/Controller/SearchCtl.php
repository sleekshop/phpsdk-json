<?php

namespace Sleekshop\Controller;

use Sleekshop\Helper\SearchHelper;
use Sleekshop\SleekshopRequest;

class SearchCtl
{

    private SleekshopRequest $request;

    public function __construct(SleekshopRequest $request)
    {
        $this->request = $request;
    }

    /**
     * This function searches for products based on the given constraints
     *
     * @param array $constraint
     * @param int $left_limit
     * @param int $right_limit
     * @param array $order_columns
     * @param string $order_type
     * @param string|null $lang
     * @param array $needed_attributes
     * @return array
     */
    public function SearchProducts(array $constraint = [], int $left_limit = 0, int $right_limit = 0, array $order_columns = [], string $order_type = 'ASC', string $lang = null, array $needed_attributes = []): array
    {
        $json = $this->request->search_products($constraint, $left_limit, $right_limit, $order_columns, $order_type, $lang, $needed_attributes);
        if ($json['status'] == 'error') {
            return $json;
        }
        $json['response'] = SearchHelper::convert_product_search_result($this->request, $json['response']);
        return $json;
    }

    /**
     * Performs a search for contents based on the provided constraints and parameters.
     *
     * @param array $constraint Array of search constraints.
     * @param int $left_limit The starting index for limiting results.
     * @param int $right_limit The ending index for limiting results.
     * @param array $order_columns Columns to order the results by.
     * @param string $order_type The type of ordering (ASC or DESC).
     * @param string|null $lang The language code for the search.
     * @param array $needed_attributes Attributes that are needed in the search results.
     *
     * @return array The search result containing the status and response.
     */
    public function SearchContents(array $constraint = [], int $left_limit = 0, int $right_limit = 0, array $order_columns = [], string $order_type = 'ASC', string $lang = null, array $needed_attributes = []): array
    {
        $json = $this->request->search_contents($constraint, $left_limit, $right_limit, $order_columns, $order_type, $lang, $needed_attributes);
        if ($json['status'] == 'error') {
            return $json;
        }
        $json['response'] = SearchHelper::convert_content_search_result($this->request, $json['response']);
        return $json;
    }

    /**
     * Performs a search for orders based on the provided constraints and parameters.
     *
     * @param array $constraint Array of search constraints.
     * @param int $left_limit The starting index for limiting results.
     * @param int $right_limit The ending index for limiting results.
     * @param string|null $lang The language code for the search.
     *
     * @return array The search result containing the status and response.
     */
    public function SearchOrders(array $constraint = [], int $left_limit = 0, int $right_limit = 0, string $lang = null): array
    {
        return $this->request->search_orders();
    }

    /**
     * Performs a search for users based on the provided constraints and parameters.
     *
     * @param array $constraint Array of search constraints.
     * @param array $order_columns Columns to order the results by.
     * @param string $order_type The type of ordering (ASC or DESC).
     * @param int $left_limit The starting index for limiting results.
     * @param int $right_limit The ending index for limiting results.
     * @param string|null $lang The language code for the search.
     *
     * @return array The search result containing users that match the criteria.
     */
    public function SearchUsers(array $constraint = [], array $order_columns = [], string $order_type = 'ASC', int $left_limit = 0, int $right_limit = 0, string $lang = null): array
    {
        return $this->request->search_users($constraint, $order_columns, $order_type, $left_limit, $right_limit, $lang);
    }

    /**
     * Performs a search for warehouse entities based on the provided constraints and parameters.
     *
     * @param array $constraint Array of search constraints.
     * @param array $order_columns Columns to order the results by.
     * @param string $order_type The type of ordering (ASC or DESC).
     * @param int $left_limit The starting index for limiting results.
     * @param int $right_limit The ending index for limiting results.
     * @param string|null $lang The language code for the search.
     * @param array $needed_attributes Attributes that are needed in the search results.
     *
     * @return array The search result containing the status and response.
     */
    public function SearchWarehouseEntities(array $constraint = [], array $order_columns = [], string $order_type = 'ASC', int $left_limit = 0, int $right_limit = 0, string $lang = null, array $needed_attributes = []): array
    {
        return $this->request->search_warehouse_entities($constraint, $order_columns, $order_type, $left_limit, $right_limit, $lang, $needed_attributes);
    }

    /**
     * Performs a search for classes based on the provided constraints and parameters.
     *
     * @param array $constraint Array of search constraints.
     * @param array $order_columns Columns to order the results by.
     * @param string $order_type The type of ordering (ASC or DESC).
     * @param int $left_limit The starting index for limiting results.
     * @param int $right_limit The ending index for limiting results.
     * @param string|null $lang The language code for the search.
     *
     * @return array The search result containing the status and response.
     */
    public function SearchClasses(array $constraint = [], array $order_columns = [], string $order_type = 'ASC', int $left_limit = 0, int $right_limit = 0, string $lang = null): array
    {
        return $this->request->search_classes($constraint, $order_columns, $order_type, $left_limit, $right_limit, $lang);
    }

    /**
     * Searches for distinct products based on the provided constraints.
     *
     * @param array $constraint An associative array of constraints to filter the search results.
     * @param string $field The specific field to search within.
     * @param string|null $lang An optional parameter to specify the language for the search results.
     *
     * @return array Returns an array of distinct products that match the specified constraints.
     */
    public function SearchDistinctProducts(array $constraint = [], string $field = '', string $lang = null): array
    {
        return $this->request->search_distinct_products($constraint, $field, $lang);
    }

}