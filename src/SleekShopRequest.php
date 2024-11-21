<?php

namespace Sleekshop;

use Sleekshop\Options\DefaultOptions;

/**
 * Class SleekShopRequest
 *
 * @package Sleekshop
 *
 * @see https://docs.sleekshop.io
 */
class SleekShopRequest
{
    private string $server;
    private string $licence_username;
    private string $licence_password;
    private string $licence_secret_key;
    private array $post_data;

    public string $token = 'sleekshop';
    public string $default_language;
    public int $product_image_thumb_height = 100;
    public int $categories_id = 2;

    /**
     * Initializes a new instance of the SleekShopRequest - class.
     *
     * @param string $server The server URL
     * @param string $licence_username The Sleekshop API licence username
     * @param string $licence_password The Sleekshop API licence password
     * @param string $licence_secret_key The Sleekshop API licence secret key (if not provided, it will be ignored)
     * @param DefaultOptions|null $options The options to be used
     */
    public function __construct(
        string $server,
        string $licence_username,
        string $licence_password,
        string $licence_secret_key = '',
        DefaultOptions $options = null
    ) {
        $this->server = $server;
        $this->licence_username = $licence_username;
        $this->licence_password = $licence_password;
        $this->licence_secret_key = $licence_secret_key;
        $this->post_data = [
            'licence_username' => $this->licence_username,
            'licence_password' => $this->licence_password
        ];
        $options = $options ?? new DefaultOptions();
        $this->default_language = $options->default_language;
        $this->token = $options->token;
        $this->product_image_thumb_height = $options->product_image_thumb_height;
        $this->template_path = $options->template_path;
        $this->categories_id = $options->categories_id;
    }

    // *****************************************************************
    // SESSIONS
    // *****************************************************************

    /**
     * Returns a valid session - code which can be used for cart - actions etc...
     *
     * @return array
     */
    public function get_new_session(): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_new_session';
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // CATEGORIES
    // *****************************************************************

    /**
     * Returns an array containing all categories with the parent determined by $id_parent
     *
     * @param int $id_parent The id of the parent category
     * @param string|null $lang The language to retrieve the categories in
     * @return array An array containing all categories with the parent determined by $id_parent
     */
    public function get_categories(int $id_parent = 0, string $lang = null): array
    {
        $lang = $lang ?? $this->default_language;

        $post_data = $this->post_data;
        $post_data['request'] = 'get_categories';
        $post_data['id_parent'] = $id_parent;
        $post_data['language'] = $lang;

        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Get products in category
     *
     * This function derives all products in a given category determined by ist id_category
     * Further we provide the left_limit and right_limit arguments which determine the range of products
     * we are interested in.
     * $lang determines the language
     * Order Column determines the order column
     * The Order determines the order
     *
     * @param int $id_category The id of the category
     * @param string|null $lang The language to retrieve the products in
     * @param array $order_columns The columns to order by
     * @param string $order The order (ASC|DESC)
     * @param int $left_limit The left limit of the products to retrieve
     * @param int $right_limit The right limit of the products to retrieve
     * @param array $needed_attributes The attributes that should be included in the result
     * @return array The result of the request in JSON format
     */
    public function get_products_in_category(int $id_category = 0, string $lang = null, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): array
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'get_products_in_category';
        $post_data['id_category'] = $id_category;
        $post_data['language'] = $lang;
        $post_data['order_columns'] = json_encode($order_columns);
        $post_data['order'] = $order;
        $post_data['left_limit'] = $left_limit;
        $post_data['right_limit'] = $right_limit;
        $post_data['needed_attributes'] = json_encode($needed_attributes);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function derives all contents in a given category determined by ist id_category
     *
     * @param int $id_category The id of the category
     * @param string|null $lang The language to retrieve the contents in
     * @param array $order_columns The columns to order by
     * @param string $order The order (ASC|DESC)
     * @param int $left_limit The left limit of the contents to retrieve
     * @param int $right_limit The right limit of the contents to retrieve
     * @param array $needed_attributes The attributes that should be included in the result
     * @return array The result of the request in JSON format
     */
    public function get_contents_in_category(int $id_category = 0, string $lang = null, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): array
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'get_contents_in_category';
        $post_data['id_category'] = $id_category;
        $post_data['language'] = $lang;
        $post_data['order_columns'] = json_encode($order_columns);
        $post_data['order'] = $order;
        $post_data['left_limit'] = $left_limit;
        $post_data['right_limit'] = $right_limit;
        $post_data['needed_attributes'] = json_encode($needed_attributes);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Retrieves all products and contents in a given category determined by its id_category
     *
     * @param int $id_category The id of the category
     * @param string|null $lang The language to retrieve the products and contents in
     * @param array $order_columns The columns to order by
     * @param string $order The order (ASC|DESC)
     * @param int $left_limit The left limit of the products and contents to retrieve
     * @param int $right_limit The right limit of the products and contents to retrieve
     * @param array $needed_attributes The attributes that should be included in the result
     * @return array The result of the request in JSON format
     */
    public function get_shopobjects_in_category(int $id_category = 0, string $lang = null, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): array
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'get_shopobjects_in_category';
        $post_data['id_category'] = $id_category;
        $post_data['language'] = $lang;
        $post_data['order_columns'] = json_encode($order_columns);
        $post_data['order'] = $order;
        $post_data['left_limit'] = $left_limit;
        $post_data['right_limit'] = $right_limit;
        $post_data['needed_attributes'] = json_encode($needed_attributes);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function dumps all products and child - categories inherited in an category determined by its id
     *
     * @param int $id_category The id of the category
     * @param string|null $lang The language to retrieve the products and contents in
     * @param array $order_columns The columns to order by
     * @param string $order The order (ASC|DESC)
     * @param int $left_limit The left limit of the products and contents to retrieve
     * @param int $right_limit The right limit of the products and contents to retrieve
     * @param array $needed_attributes The attributes that should be included in the result
     * @return array The result of the request in JSON format
     */
    public function dump_category(int $id_category = 0, string $lang = null, $country = '', array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = [], int $depth = 0): array
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'dump_category';
        $post_data['id_category'] = $id_category;
        $post_data['language'] = $lang;
        $post_data['country'] = $country;
        $post_data['order_columns'] = json_encode($order_columns);
        $post_data['order'] = $order;
        $post_data['left_limit'] = $left_limit;
        $post_data['right_limit'] = $right_limit;
        $post_data['needed_attributes'] = json_encode($needed_attributes);
        $post_data['depth'] = $depth;

        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Retrieves all products in a given category determined by its permalink
     * @param string $permalink The permalink of the category
     * @param string|null $country
     * @param array $order_columns The columns to order by
     * @param string $order The order (ASC|DESC)
     * @param int $left_limit The left limit of the products to retrieve
     * @param int $right_limit The right limit of the products to retrieve
     * @param array $needed_attributes The attributes that should be included in the result
     * @return array The result of the request in JSON format
     */
    public function seo_get_products_in_category(string $permalink = '', string $country = null, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'seo_get_products_in_category';
        $post_data['permalink'] = $permalink;
        $post_data['country'] = $country;
        $post_data['order_columns'] = json_encode($order_columns);
        $post_data['order'] = $order;
        $post_data['left_limit'] = $left_limit;
        $post_data['right_limit'] = $right_limit;
        $post_data['needed_attributes'] = json_encode($needed_attributes);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Retrieves all contents in a given category determined by its permalink
     *
     * @param string $permalink The permalink of the category
     * @param array $order_columns The columns to order by
     * @param string $order The order (ASC|DESC)
     * @param int $left_limit The left limit of the contents to retrieve
     * @param int $right_limit The right limit of the contents to retrieve
     * @param array $needed_attributes The attributes that should be included in the result
     * @return array The result of the request in JSON format
     */
    public function seo_get_contents_in_category(string $permalink = '', array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'seo_get_contents_in_category';
        $post_data['permalink'] = $permalink;
        $post_data['order_columns'] = json_encode($order_columns);
        $post_data['order'] = $order;
        $post_data['left_limit'] = $left_limit;
        $post_data['right_limit'] = $right_limit;
        $post_data['needed_attributes'] = json_encode($needed_attributes);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Retrieves all shopobjects in a given category determined by its permalink
     *
     * @param string $permalink The permalink of the category
     * @param array $order_columns The columns to order by
     * @param string $order The order (ASC|DESC)
     * @param int $left_limit The left limit of the shopobjects to retrieve
     * @param int $right_limit The right limit of the shopobjects to retrieve
     * @param array $needed_attributes The attributes that should be included in the result
     * @return array The result of the request in JSON format
     */
    public function seo_get_shopobjects_in_category(
        string $permalink = '',
        array  $order_columns = [],
        string $order = 'ASC',
        int    $left_limit = 0,
        int    $right_limit = 0,
        array  $needed_attributes = []
    ): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'seo_get_shopobjects_in_category';
        $post_data['permalink'] = $permalink;
        $post_data['order_columns'] = json_encode($order_columns);
        $post_data['order'] = $order;
        $post_data['left_limit'] = $left_limit;
        $post_data['right_limit'] = $right_limit;
        $post_data['needed_attributes'] = json_encode($needed_attributes);

        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Creates a new category with the given parameters.
     *
     * @param int $id_parent The id of the parent category
     * @param string $name The name of the category
     * @param array $labels The labels for the category
     * @param array $attributes The attributes for the category
     * @param array $seo The seo informations for the category
     * @return array The result of the request
     */
    public function create_category(int $id_parent = 0, string $name = '', array $labels = [], array $attributes = [], array $seo = []): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'create_category';
        $post_data['id_parent'] = $id_parent;
        $post_data['name'] = $name;
        $post_data['labels'] = json_encode($labels);
        $post_data['attributes'] = json_encode($attributes);
        $post_data['seo'] = json_encode($seo);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Updates a category with the given parameters.
     *
     * @param int $id_category The id of the category
     * @param string $name The name of the category
     * @param array $labels The labels for the category
     * @param array $attributes The attributes for the category
     * @param array $seo The seo informations for the category
     * @return array The result of the request
     */
    public function update_category(int $id_category = 0, string $name = '', array $labels = [], array $attributes = [], array $seo = []): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'update_category';
        $post_data['id_category'] = $id_category;
        $post_data['name'] = $name;
        $post_data['labels'] = json_encode($labels);
        $post_data['attributes'] = json_encode($attributes);
        $post_data['seo'] = json_encode($seo);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Deletes a category with the given id.
     *
     * @param int $id_category The id of the category
     * @return array The result of the request
     */
    public function delete_category(int $id_category): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'delete_category';
        $post_data['id_category'] = $id_category;
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // CLASSES
    // *****************************************************************

    /**
     * This function returns class details of a given class determined by its id_class
     *
     * @param int $id_class
     * @return array
     */
    public function get_class_details(int $id_class): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'get_class_details';
        $post_data['id_class'] = $id_class;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function creates a new class with the given parameters
     *
     * @param string $name
     * @param string $type
     * @return array
     */
    public function create_class(string $name, string $type): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'create_class';
        $post_data['name'] = $name;
        $post_data['type'] = $type;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function deletes a class determined by its id
     *
     * @param int $id_class
     * @return array
     */
    public function delete_class(int $id_class): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'delete_class';
        $post_data['id_class'] = $id_class;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function creates class attributes for a given class
     *
     * @param int $id_class
     * @param array $attributes
     * @return array
     */
    public function create_class_attributes(int $id_class, array $attributes): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'create_class_attributes';
        $post_data['id_class'] = $id_class;
        $post_data['attributes'] = json_encode($attributes);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function deletes class attributes for a given class
     *
     * @param int $id_class
     * @param array $attributes
     * @return array
     */
    public function delete_class_attributes(int $id_class, array $attributes): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'delete_class_attributes';
        $post_data['id_class'] = $id_class;
        $post_data['attributes'] = json_encode($attributes);
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // PRODUCTS
    // *****************************************************************

    /**
     * This function returns the product details of a given product determined by its id_product
     *
     * @param int $id_product The id of the product
     * @param string|null $lang The language to retrieve the product in
     * @param array $needed_attributes The attributes that should be included in the result
     * @return array The result of the request in XML format
     */
    public function get_product_details(int $id_product = 0, string $lang = null, array $needed_attributes = []): array
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'get_product_details';
        $post_data['language'] = $lang;
        $post_data['id_product'] = $id_product;
        $post_data['needed_attributes'] = json_encode($needed_attributes);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Retrieves all products in a given category determined by its permalink
     *
     * @param string $permalink The permalink of the product to retrieve details for.
     * @param array $needed_attributes Optional list of attributes to include in the response.
     *
     * @return array The result of the request
     */
    public function seo_get_product_details(string $permalink = '', array $needed_attributes = []): array
    {
        // Set up the request data
        $post_data = $this->post_data;
        $post_data['request'] = 'seo_get_product_details'; // Set the request type
        $post_data['permalink'] = $permalink; // Set the permalink of the product to retrieve
        $post_data['needed_attributes'] = json_encode($needed_attributes); // Encode the needed attributes as JSON

        // Send the request to the server and return the response
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Creates a new product with the given parameters.
     *
     * @param string $class The class of the product
     * @param string $name The name of the product
     * @param array $attributes The attributes for the product
     * @param array $metadata The metadata for the product
     * @param array $seo The seo informations for the product
     * @param array $availability The availability informations for the product
     * @return array The result of the request
     */
    public function create_product(string $class, string $name, int $shop_active, array $attributes, array $metadata, array $seo, array $availability): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'create_product';
        $post_data['class'] = $class;
        $post_data['name'] = $name;
        $post_data['shop_active'] = $shop_active;
        $post_data['attributes'] = json_encode($attributes);
        $post_data['metadata'] = json_encode($metadata);
        $post_data['seo'] = json_encode($seo);
        $post_data['availability'] = json_encode($availability);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Updates a product with the given parameters.
     *
     * @param int $id_product The id of the product
     * @param string $name The name of the product
     * @param array $attributes The attributes for the product
     * @param array $metadata The metadata for the product
     * @param array $seo The seo informations for the product
     * @param array $availability The availability informations for the product
     * @return array The result of the request
     */
    public function update_product(int $id_product, string $name, int $shop_active, array $attributes, array $metadata, array $seo, array $availability): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'update_product';
        $post_data['id_product'] = $id_product;
        $post_data['name'] = $name;
        $post_data['shop_active'] = $shop_active;
        $post_data['attributes'] = json_encode($attributes);
        $post_data['metadata'] = json_encode($metadata);
        $post_data['seo'] = json_encode($seo);
        $post_data['availability'] = json_encode($availability);

        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Creates a new variation with the given parameters.
     *
     * @param int $id_product The id of the product
     * @param string $name The name of the variation
     * @param int $shop_active
     * @param array $attributes The attributes for the variation
     * @param array $metadata The metadata for the variation
     * @param array $seo The seo informations for the variation
     * @param array $availability The availability informations for the variation
     * @return array The result of the request
     */
    public function create_variation(int $id_product, string $name, int $shop_active, array $attributes, array $metadata, array $seo, array $availability): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'create_variation';
        $post_data['id_product'] = $id_product;
        $post_data['name'] = $name;
        $post_data['shop_active'] = $shop_active;
        $post_data['attributes'] = json_encode($attributes);
        $post_data['metadata'] = json_encode($metadata);
        $post_data['seo'] = json_encode($seo);
        $post_data['availability'] = json_encode($availability);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Deletes a product with the given id.
     *
     * @param int $id_product The id of the product
     * @return array The result of the request
     */
    public function delete_product(int $id_product): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'delete_product';
        $post_data['id_product'] = $id_product;
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // CONTENTS
    // *****************************************************************

    /**
     * Retrieves content object by id
     *
     * @param int $id_content The id of the content
     * @param string|null $lang The language to retrieve the content in
     * @return array The result of the request in XML format
     */
    public function get_content_details(int $id_content = 0, string $lang = null): array
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'get_content_details';
        $post_data['language'] = $lang;
        $post_data['id_content'] = $id_content;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Retrieves content object by permalink
     *
     * @param string $permalink
     * @return array
     */
    public function seo_get_content_details(string $permalink = ''): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'seo_get_content_details';
        $post_data['permalink'] = $permalink;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Creates a new content with the given parameters.
     *
     * @param string $class The class of the content
     * @param string $name The name of the content
     * @param int $shop_active
     * @param array $attributes The attributes for the content
     * @param array $seo The seo informations for the content
     * @return array The result of the request
     */
    public function create_content(string $class, string $name, int $shop_active, array $attributes, array $seo): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'create_content';
        $post_data['class'] = $class;
        $post_data['name'] = $name;
        $post_data['shop_active'] = $shop_active;
        $post_data['attributes'] = json_encode($attributes);
        $post_data['seo'] = json_encode($seo);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Updates a content with the given parameters.
     *
     * @param int $id_content The id of the content
     * @param string $name The name of the content
     * @param array $attributes The attributes for the content
     * @param array $seo The seo informations for the content
     * @return array The result of the request
     */
    public function update_content(int $id_content, string $name, int $shop_active, array $attributes, array $seo): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'update_content';
        $post_data['id_content'] = $id_content;
        $post_data['name'] = $name;
        $post_data['shop_active'] = $shop_active;
        $post_data['attributes'] = json_encode($attributes);
        $post_data['seo'] = json_encode($seo);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Deletes a content with the given id.
     *
     * @param int $id_content The id of the content
     * @return array The result of the request
     */
    public function delete_content(int $id_content): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'delete_content';
        $post_data['id_content'] = $id_content;
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // SEARCH
    // *****************************************************************

    /**
     * This function allows us to search in the product - data
     *
     * @param array $constraint The constraints to search for
     * @param int $left_limit The left limit of the search
     * @param int $right_limit The right limit of the search
     * @param array $order_columns The columns to order by
     * @param string $order_type The order type (ASC|DESC)
     * @param string|null $lang The language to retrieve the products in
     * @param array $needed_attributes The attributes that should be included in the result
     * @return array The result of the request in JSON format
     */
    public function search_products(array $constraint = [], int $left_limit = 0, int $right_limit = 0, array $order_columns = [], string $order_type = 'ASC', string $lang = null, array $needed_attributes = []): array
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'search_products';
        $i = 0;
        $post_data['constraint'] = json_encode($constraint);
        $post_data['left_limit'] = $left_limit;
        $post_data['right_limit'] = $right_limit;
        $post_data['order_columns'] = json_encode($order_columns);
        $post_data['needed_attributes'] = json_encode($needed_attributes);
        $post_data['order_type'] = $order_type;
        $post_data['language'] = $lang;
        return ($this->snd_request($this->server, $post_data));
    }

    /**
     * This function allows us to search distinct in the product - data
     *
     * @param array $constraint The constraints to search for
     * @param int $left_limit
     * @param int $right_limit
     * @param array $order_columns
     * @param string $order_type
     * @param string|null $lang The language to retrieve the products in
     * @param array $needed_attributes
     * @return array The result of the request in JSON format
     */
    public function search_contents(array $constraint = [], int $left_limit = 0, int $right_limit = 0, array $order_columns = [], string $order_type = 'ASC', string $lang = null, array $needed_attributes = []): array
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'search_contents';
        $i = 0;
        $post_data['constraint'] = json_encode($constraint);
        $post_data['left_limit'] = $left_limit;
        $post_data['right_limit'] = $right_limit;
        $post_data['order_columns'] = json_encode($order_columns);
        $post_data['needed_attributes'] = json_encode($needed_attributes);
        $post_data['order_type'] = $order_type;
        $post_data['language'] = $lang;
        return ($this->snd_request($this->server, $post_data));
    }

    /**
     * This function allows us to search in the order - data
     *
     * @param array $constraint The constraints to search for
     * @param int $left_limit The left limit of the search
     * @param int $right_limit The right limit of the search
     * @param string|null $lang The language to retrieve the orders in
     * @return array The result of the request in JSON format
     */
    public function search_orders(array $constraint = [], int $left_limit = 0, int $right_limit = 0, string $lang = null): array
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'search_orders';
        $post_data['constraint'] = json_encode($constraint);
        $post_data['left_limit'] = $left_limit;
        $post_data['right_limit'] = $right_limit;
        $post_data['language'] = $lang;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function allows us to search in the user - data
     *
     * @param array $constraint The constraints to search for
     * @param array $order_columns The columns to order by
     * @param string $order_type The order type (ASC|DESC)
     * @param int $left_limit The left limit of the search
     * @param int $right_limit The right limit of the search
     * @param string|null $lang The language to retrieve the users in
     * @return array The result of the request in JSON format
     */
    public function search_users(array $constraint = [], array $order_columns = [], string $order_type = 'ASC', int $left_limit = 0, int $right_limit = 0, string $lang = null): array
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'search_users';
        $post_data['constraint'] = json_encode($constraint);
        $post_data['order_columns'] = json_encode($order_columns);
        $post_data['order_type'] = $order_type;
        $post_data['left_limit'] = $left_limit;
        $post_data['right_limit'] = $right_limit;
        $post_data['language'] = $lang;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function allows us to search in the warehouse - data
     *
     * @param array $constraint The constraints to search for
     * @param array $order_columns The columns to order by
     * @param string $order_type The order type (ASC|DESC)
     * @param int $left_limit The left limit of the search
     * @param int $right_limit The right limit of the search
     * @param string|null $lang The language to retrieve the warehouse entities in
     * @param array $needed_attributes The attributes that should be included in the result
     * @return array The result of the request in JSON format
     */
    public function search_warehouse_entities(array $constraint = [], array $order_columns = [], string $order_type = 'ASC', int $left_limit = 0, int $right_limit = 0, string $lang = null, array $needed_attributes = []): array
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'search_warehouse_entities';
        $post_data['constraint'] = json_encode($constraint);
        $post_data['order_columns'] = json_encode($order_columns);
        $post_data['order_type'] = $order_type;
        $post_data['left_limit'] = $left_limit;
        $post_data['right_limit'] = $right_limit;
        $post_data['language'] = $lang;
        $post_data['needed_attributes'] = json_encode($needed_attributes);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function allows us to search in the class - data
     *
     * @param array $constraint The constraints to search for
     * @param array $order_columns The columns to order by
     * @param string $order_type The order type (ASC|DESC)
     * @param int $left_limit The left limit of the search
     * @param int $right_limit The right limit of the search
     * @param string|null $lang The language to retrieve the classes in
     * @return array The result of the request in JSON format
     */
    public function search_classes(array $constraint = [], array $order_columns = [], string $order_type = 'ASC', int $left_limit = 0, int $right_limit = 0, string $lang = null): array
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'search_classes';
        $post_data['constraint'] = json_encode($constraint);
        $post_data['order_columns'] = json_encode($order_columns);
        $post_data['order_type'] = $order_type;
        $post_data['left_limit'] = $left_limit;
        $post_data['right_limit'] = $right_limit;
        $post_data['language'] = $lang;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function allows us to search distinct products
     *
     * @param array $constraint The constraints to search for
     * @param string $field The field to search in
     * @param string|null $lang The language to retrieve the products in
     * @return array The result of the request in JSON format
     */
    public function search_distinct_products(array $constraint = [], string $field = '', string $lang = null): array
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'search_distinct_products';
        $post_data['constraint'] = json_encode($constraint);
        $post_data['field'] = $field;
        $post_data['language'] = $lang;
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // CART
    // *****************************************************************

    /**
     * This functions adds a product to the cart in session
     *
     * @param string $session
     * @param int $id_product
     * @param float $quantity
     * @param string $price_field
     * @param string $name_field
     * @param string $description_field
     * @param string|null $language
     * @param string $element_type
     * @param int $id_parent_element
     * @param array $attributes
     * @return array
     */
    public function add_to_cart(string $session = '', int $id_product = 0, float $quantity = 0, string $price_field = '', string $name_field = '', string $description_field = '', string $language = null, string $element_type = 'PRODUCT', int $id_parent_element = 0, array $attributes = []): array
    {
        $language = $language ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'add_to_cart';
        $post_data['session'] = $session;
        $post_data['id_shopobject'] = $id_product;
        $post_data['id_parent_element'] = $id_parent_element;
        $post_data['element_type'] = $element_type;
        $post_data['quantity'] = $quantity;
        $post_data['price_field'] = $price_field;
        $post_data['name_field'] = $name_field;
        $post_data['description_field'] = $description_field;
        $post_data['language'] = $language;
        $post_data['attributes'] = json_encode($attributes);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function subtracts a product from the cart in session
     *
     * @param string $session
     * @param int $id_element
     * @return array
     */
    public function sub_from_cart(string $session = '', int $id_element = 0): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'sub_from_cart';
        $post_data['session'] = $session;
        $post_data['id_element'] = $id_element;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function deletes a product from the cart in session
     *
     * @param string $session
     * @param int $id_element
     * @return array
     */
    public function del_from_cart(string $session = '', int $id_element = 0): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'del_from_cart';
        $post_data['session'] = $session;
        $post_data['id_element'] = $id_element;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function clears the cart in session
     *
     * @param string $session
     * @return array
     */
    public function clear_cart(string $session = ''): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'clear_cart';
        $post_data['session'] = $session;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function gets the cart in session
     *
     * @param string $session
     * @return array
     */
    public function get_cart(string $session = ''): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_cart';
        $post_data['session'] = $session;
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // USER
    // *****************************************************************

    /**
     * This function registers a new user with the given arguments.
     *
     * @param array $args
     * @param null $language
     * @return array
     */
    public function register_user(array $args = [], $language = null): array
    {
        $language = $language ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'register_user';
        $post_data['args'] = json_encode($args);
        $post_data['language'] = $language;
        return ($this->snd_request($this->server, $post_data));
    }

    /**
     * This function verifies a user with the given session.
     *
     * @param int $id_user
     * @param string $session_id
     * @return array
     */
    public function verify_user(int $id_user = 0, string $session_id = ''): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'verify_user';
        $post_data['id_user'] = $id_user;
        $post_data['session_id'] = $session_id;
        return ($this->snd_request($this->server, $post_data));
    }

    /**
     * This function logs in a user with the given session.
     *
     * @param string $session
     * @param string $username
     * @param string $password
     * @return array
     */
    public function login_user(string $session = '', string $username = '', string $password = ''): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'login_user';
        $post_data['session'] = $session;
        $post_data['username'] = $username;
        $post_data['password'] = $password;
        return ($this->snd_request($this->server, $post_data));
    }

    /**
     * This function logs out a user with the given session.
     *
     * @param string $session
     * @return array
     */
    public function logout_user(string $session = ''): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'logout_user';
        $post_data['session'] = $session;
        return ($this->snd_request($this->server, $post_data));
    }

    /**
     * This function sets a new password for a user with the given session.
     *
     * @param string $session
     * @param string $old_password
     * @param string $new_password1
     * @param string $new_password2
     * @return array
     */
    public function set_user_password(string $session, string $old_password, string $new_password1, string $new_password2): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'set_user_password';
        $post_data['session'] = $session;
        $post_data['old_passwd'] = $old_password;
        $post_data['new_passwd1'] = $new_password1;
        $post_data['new_passwd2'] = $new_password2;
        return ($this->snd_request($this->server, $post_data));
    }

    /**
     * This function resets the password for a user with the given arguments.
     *
     * @param array $args
     * @return array
     */
    public function reset_user_password(array $args = []): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'reset_user_password';
        $post_data['args'] = json_encode($args);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function gets the user orders for a user with the given session.
     *
     * @param string $session
     * @return array
     */
    public function get_user_orders(string $session = ''): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_user_orders';
        $post_data['session'] = $session;
        return ($this->snd_request($this->server, $post_data));
    }

    /**
     * This function gets the user data for a user with the given session.
     *
     * @param string $session
     * @return array
     */
    public function get_user_data(string $session = ''): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_user_data';
        $post_data['session'] = $session;
        return ($this->snd_request($this->server, $post_data));
    }

    /**
     * This function gets the user data for a user with the given id.
     *
     * @param int $id_user
     * @return array
     */
    public function get_user_by_id(int $id_user = 0): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_user_by_id';
        $post_data['id_user'] = $id_user;
        return ($this->snd_request($this->server, $post_data));
    }

    /**
     * This function sets the user data for a user with the given session.
     *
     * @param string $session
     * @param array $args
     * @return array
     */
    public function set_user_data(string $session = '', array $args = []): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'set_user_data';
        $post_data['session'] = $session;
        $post_data['attributes'] = json_encode($args);
        return ($this->snd_request($this->server, $post_data));
    }

    /**
     * This function updates the user data for a user with the given id.
     *
     * @param int $id_user
     * @param array $args
     * @return array
     */
    public function update_user_data(int $id_user = 0, array $args = []): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'update_user_data';
        $post_data['id_user'] = $id_user;
        $post_data['attributes'] = json_encode($args);
        return ($this->snd_request($this->server, $post_data));
    }

    /**
     * Instant login
     *
     * @param string $token The login token
     * @return array The server response
     */
    public function instant_login(string $token = '', string $application_token = ''): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'instant_login';
        $post_data['token'] = $token;
        $post_data['application_token'] = $application_token;
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // ORDERS
    // *****************************************************************

    /**
     * This function sets the order details for a user with the given session.
     *
     * @param string $session
     * @param array $args
     * @return array
     */
    public function set_order_details(string $session = '', array $args = []): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'set_order_details';
        $post_data['session'] = $session;
        foreach ($args as $key => $value) {
            if ($key == 'attributes') $value = json_encode($value);
            $post_data[$key] = $value;
        }
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function gets the order details for a user with the given session.
     *
     * @param string $session
     * @return array
     */
    public function get_order_details(string $session = ''): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_order_details';
        $post_data['session'] = $session;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function gets the order details for a user with the given session.
     *
     * @param int $id_order
     * @param string|null $language
     * @return array
     */
    public function get_order_by_id(int $id_order = 0, string $language = null): array
    {
        $language = $language ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'get_order_by_id';
        $post_data['id_order'] = $id_order;
        $post_data['language'] = $language;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function updates the order details for a given id_order
     *
     * @param int $id_order The id of the order you want to update.
     * @param int $id_payment_method A valid id specifying the desired payment method. This id can be identified with the get_payment_methods request.
     * @param int $id_delivery_method A valid delivery id.
     * @param string $order_state A valid order state. Valid values: OPEN, PROCESSING, CLOSED, and CANCELED.
     * @param string $order_payment_state Here you can set the payment state. Valid values: PAYMENT_NOT_RECEIVED or PAYMENT_RECEIVED.
     * @param string $order_delivery_state Here you can set the delivery state. Valid values: PROCESSING or CLOSED.
     * @param string $delivery_companyname The delivery company name.
     * @param string $delivery_department The delivery department.
     * @param string $delivery_salutation The delivery salutation.
     * @param string $delivery_firstname The delivery first name.
     * @param string $delivery_lastname The delivery last name.
     * @param string $delivery_street The delivery street.
     * @param string $delivery_number The delivery number.
     * @param string $delivery_zip The delivery zip code.
     * @param string $delivery_state The delivery state.
     * @param string $delivery_city The delivery city.
     * @param string $delivery_country A valid delivery country code.
     * @param string $invoice_companyname The invoice company name.
     * @param string $invoice_department The invoice department.
     * @param string $invoice_salutation The invoice salutation.
     * @param string $invoice_firstname The invoice first name.
     * @param string $invoice_lastname The invoice last name.
     * @param string $invoice_street The invoice street.
     * @param string $invoice_number The invoice number.
     * @param string $invoice_zip The invoice zip code.
     * @param string $invoice_state The invoice state.
     * @param string $invoice_city The invoice city.
     * @param string $invoice_country A valid invoice country code.
     * @param string $note A note that has to be attached to the order.
     * @param string $email A valid email for the order.
     * @param string $phone A phone number that has to be attached to the order.
     * @param array $attributes An array containing additional attributes if needed.
     * @return array The result of the request
     */
    public function update_order_details(
        int    $id_order = 0,
        int    $id_payment_method = 0,
        int    $id_delivery_method = 0,
        string $order_state = '',
        string $order_payment_state = '',
        string $order_delivery_state = '',
        string $delivery_companyname = '',
        string $delivery_department = '',
        string $delivery_salutation = '',
        string $delivery_firstname = '',
        string $delivery_lastname = '',
        string $delivery_street = '',
        string $delivery_number = '',
        string $delivery_zip = '',
        string $delivery_state = '',
        string $delivery_city = '',
        string $delivery_country = '',
        string $invoice_companyname = '',
        string $invoice_department = '',
        string $invoice_salutation = '',
        string $invoice_firstname = '',
        string $invoice_lastname = '',
        string $invoice_street = '',
        string $invoice_number = '',
        string $invoice_zip = '',
        string $invoice_state = '',
        string $invoice_city = '',
        string $invoice_country = '',
        string $note = '',
        string $email = '',
        string $phone = '',
        array  $attributes = []
    ): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'update_order_details';
        $post_data['id_order'] = $id_order;
        $post_data['id_payment_method'] = $id_payment_method;
        $post_data['id_delivery_method'] = $id_delivery_method;
        $post_data['order_state'] = $order_state;
        $post_data['order_payment_state'] = $order_payment_state;
        $post_data['order_delivery_state'] = $order_delivery_state;
        $post_data['delivery_companyname'] = $delivery_companyname;
        $post_data['delivery_department'] = $delivery_department;
        $post_data['delivery_salutation'] = $delivery_salutation;
        $post_data['delivery_firstname'] = $delivery_firstname;
        $post_data['delivery_lastname'] = $delivery_lastname;
        $post_data['delivery_street'] = $delivery_street;
        $post_data['delivery_number'] = $delivery_number;
        $post_data['delivery_zip'] = $delivery_zip;
        $post_data['delivery_state'] = $delivery_state;
        $post_data['delivery_city'] = $delivery_city;
        $post_data['delivery_country'] = $delivery_country;
        $post_data['invoice_companyname'] = $invoice_companyname;
        $post_data['invoice_department'] = $invoice_department;
        $post_data['invoice_salutation'] = $invoice_salutation;
        $post_data['invoice_firstname'] = $invoice_firstname;
        $post_data['invoice_lastname'] = $invoice_lastname;
        $post_data['invoice_street'] = $invoice_street;
        $post_data['invoice_number'] = $invoice_number;
        $post_data['invoice_zip'] = $invoice_zip;
        $post_data['invoice_state'] = $invoice_state;
        $post_data['invoice_city'] = $invoice_city;
        $post_data['invoice_country'] = $invoice_country;
        $post_data['note'] = $note;
        $post_data['email'] = $email;
        $post_data['phone'] = $phone;
        $post_data['attributes'] = json_encode($attributes);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function creates a new order with the given arguments.
     *
     * @param string $session
     * @return array
     */
    public function checkout(string $session = ''): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'checkout';
        $post_data['session'] = $session;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function gets the invoice for an order with the given id.
     *
     * @param int $id_order
     * @return array
     */
    public function get_invoice(int $id_order = 0): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_invoice';
        $post_data['id_order'] = $id_order;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function gets the order confirmation for an order with the given id.
     *
     * @param int $id_order
     * @param array $args
     * @return array
     */
    public function get_order_confirmation(int $id_order = 0, array $args = []): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_order_confirmation';
        $post_data['id_order'] = $id_order;
        $post_data['args'] = json_encode($args);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function gets the delivery countries
     *
     * @return array
     */
    public function get_delivery_countries(): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_delivery_countries';
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // PAYMENT
    // *****************************************************************

    /**
     * This function gets the payment methods
     *
     * @return array
     */
    public function get_payment_methods(): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_payment_methods';
        return ($this->snd_request($this->server, $post_data));
    }

    /**
     * This function initiates a payment with the given arguments for an order with the given id.
     *
     * @param int $id_order
     * @param array $args
     * @return array
     */
    public function do_payment(int $id_order = 0, array $args = []): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'do_payment';
        $post_data['id_order'] = $id_order;
        $post_data['args'] = json_encode($args);
        return ($this->snd_request($this->server, $post_data));
    }

    /**
     * This function adds delivery costs to the cart
     *
     * @param string $session
     * @param array $delivery_costs
     * @return array
     */
    public function add_delivery_costs(string $session = '', array $delivery_costs = []): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'add_delivery_costs';
        $post_data['session'] = $session;
        $post_data['delivery_costs'] = json_encode($delivery_costs);
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // AGGREGATE
    // *****************************************************************

    /**
     * This function aggregates the data with the given pipe.
     *
     * @param array $pipe The pipe to aggregate the data with
     * @return array The result of the request in JSON format
     */
    public function aggregate(array $pipe = []): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'aggregate';
        $post_data['pipe'] = json_encode($pipe);
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // COUPONS
    // *****************************************************************

    /**
     * This function adds a coupon to the cart
     *
     * @param string $session
     * @param array $coupons
     * @return array
     */
    public function add_coupons(string $session = '', array $coupons = []): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'add_coupons';
        $post_data['session'] = $session;
        $post_data['coupons'] = json_encode($coupons);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function creates a new coupon with the given arguments.
     *
     * @param int $count
     * @param string $name
     * @param float $amount
     * @param string $type
     * @return array
     */
    public function create_coupons(int $count = 0, string $name = '', float $amount = 0, string $type = 'UNIQUE_NOMINAL'): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'create_coupons';
        $post_data['count'] = $count;
        $post_data['name'] = $name;
        $post_data['amount'] = $amount;
        $post_data['type'] = $type;
        return $this->snd_request($this->server, $post_data);
    }


    // *****************************************************************
    // SERVER
    // *****************************************************************

    /**
     * This function gets the status of the server
     *
     * @return array
     */
    public function get_status(): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_status';
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function creates a new channel with the given arguments.
     *
     * @param string $name
     * @param string $description
     * @param int $shop_active
     * @param string $server_output
     * @return array
     */
    public function create_channel(string $name = '', string $description = '', int $shop_active = 0, string $server_output = 'json'): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'create_channel';
        $post_data['name'] = $name;
        $post_data['description'] = $description;
        $post_data['shop_active'] = $shop_active;
        $post_data['server_output'] = $server_output;
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // APPLICATIONS
    // *****************************************************************

    /**
     * This function calls an application with the given arguments.
     *
     * @param string $application
     * @param string $app_request
     * @param array $args
     * @return array
     */
    public function application_api_call(string $application = '', string $app_request = '', array $args = []): array
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'application_api_call';
        $post_data['application'] = $application;
        $post_data['app_request'] = $app_request;
        $post_data['args'] = json_encode($args);
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // WAREHOUSE
    // *****************************************************************

    /**
     * This function creates a new warehouse entity with the given arguments.
     *
     * @param string $class
     * @param string $name
     * @param int $id_manufacturer
     * @param array $attributes
     * @param array $metadata
     * @return array
     */
    public function create_warehouse_entity(string $class = '', string $name = '', int $id_manufacturer = 0, array $attributes = [], array $metadata = []): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'create_warehouse_entity';
        $post_data['class'] = $class;
        $post_data['name'] = $name;
        $post_data['id_manufacturer'] = $id_manufacturer;
        $post_data['attributes'] = json_encode($attributes);
        $post_data['metadata'] = json_encode($metadata);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function updates a warehouse entity with the given arguments.
     *
     * @param int $id_warehouse_entity
     * @param string $name
     * @param int $id_manufacturer
     * @param array $attributes
     * @param array $metadata
     * @return array
     */
    public function update_warehouse_entity(int $id_warehouse_entity, string $name, int $id_manufacturer, array $attributes, array $metadata): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'update_warehouse_entity';
        $post_data['id_warehouse_entity'] = $id_warehouse_entity;
        $post_data['name'] = $name;
        $post_data['id_manufacturer'] = $id_manufacturer;
        $post_data['attributes'] = json_encode($attributes);
        $post_data['metadata'] = json_encode($metadata);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function deletes a warehouse entity with the given id.
     *
     * @param int $id_warehouse_entity
     * @return array
     */
    public function delete_warehouse_entity(int $id_warehouse_entity): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'delete_warehouse_entity';
        $post_data['id_warehouse_entity'] = $id_warehouse_entity;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function places an inventory with the given arguments.
     *
     * @param string $storage
     * @param string $element_number
     * @param int $quantity
     * @param string $note
     * @return array
     */
    public function inventory_place(string $storage = '', string $element_number = '', int $quantity = 0, string $note = ''): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'inventory_place';
        $post_data['storage'] = $storage;
        $post_data['element_number'] = $element_number;
        $post_data['quantity'] = $quantity;
        $post_data['note'] = $note;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function takes an inventory with the given arguments.
     *
     * @param string $storage
     * @param string $element_number
     * @param int $quantity
     * @param string $note
     * @return array
     */
    public function inventory_take(string $storage = '', string $element_number = '', int $quantity = 0, string $note = ''): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'inventory_take';
        $post_data['storage'] = $storage;
        $post_data['element_number'] = $element_number;
        $post_data['quantity'] = $quantity;
        $post_data['note'] = $note;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function adds a binding with the given arguments.
     *
     * @param int $id_product
     * @param string $element_number
     * @param int $quantity
     * @return array
     */
    public function add_binding(int $id_product = 0, string $element_number = '', int $quantity = 0): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'add_binding';
        $post_data['id_product'] = $id_product;
        $post_data['element_number'] = $element_number;
        $post_data['quantity'] = $quantity;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function deletes a binding with the given arguments.
     *
     * @param int $id_product
     * @param string $element_number
     * @return array
     */
    public function delete_binding(int $id_product = 0, string $element_number = ''): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'delete_binding';
        $post_data['id_product'] = $id_product;
        $post_data['element_number'] = $element_number;
        return $this->snd_request($this->server, $post_data);
    }


    // *****************************************************************
    // WEBHOOKS
    // *****************************************************************

    /**
     * This function creates a new webhook with the given arguments.
     *
     * @param string $name
     * @param string $event
     * @return array
     */
    public function create_webhook(string $name = '', string $event = ''): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'create_webhook';
        $post_data['name'] = $name;
        $post_data['event'] = $event;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * This function updates a webhook with the given arguments.
     *
     * @param string $name
     * @param string $url
     * @param string $parameter
     * @return array
     */

    public function update_webhook(string $name = '', string $url = '', string $parameter = ''): array
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'update_webhook';
        $post_data['name'] = $name;
        $post_data['url'] = $url;
        $post_data['parameter'] = $parameter;
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // INTERNAL
    // *****************************************************************

    /**
     * Send a POST request to the given URL with the given post data.
     *
     * @param string $url The URL to send the request to
     * @param array $postData The data to send in the request body
     * @param string $userAgent The value to send in the User-Agent header
     * @return array The response from the server formatted as array with status and response keys
     */
    private function snd_request(string $url, array $postData, string $userAgent = 'PHPPost/1.0'): array
    {
        $ch = curl_init();

        if ($ch === false) {
            return [
                'status' => 'error',
                'message' => 'Failed to initialize cURL.'
            ];
        }

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/x-www-form-urlencoded"
        ]);

        // Execute and handle response
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($response === false) {
            $errorMessage = curl_error($ch);
            curl_close($ch);
            return [
                'status' => 'error',
                'message' => "cURL error: $errorMessage"
            ];
        }

        curl_close($ch);

        // Handle HTTP status codes
        if ($httpCode >= 400) {
            return [
                'status' => 'error',
                'message' => "HTTP error: $httpCode",
                'response' => $response
            ];
        }

        // Parse JSON response
        $responseData = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'status' => 'error',
                'message' => 'Invalid JSON response',
                'response' => $response
            ];
        }

        // Check for specific error messages in the response
        if (isset($responseData['object']) && $responseData['object'] === 'error') {
            return [
                'status' => 'error',
                'message' => $responseData['message'],
                'response' => $responseData
            ];
        }

        // Successful response
        return [
            'status' => 'success',
            'response' => $responseData
        ];
    }

}