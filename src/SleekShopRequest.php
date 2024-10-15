<?php

namespace Sleekshop;

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

    /**
     * Initializes a new instance of the SleekShopRequest - class.
     *
     * @param string $server The server URL
     * @param string $licence_username The Sleekshop API licence username
     * @param string $licence_password The Sleekshop API licence password
     * @param string $licence_secret_key The Sleekshop API licence secret key (if not provided, it will be ignored)
     * @param array $options The options to be used, currently only supports 'default_language'
     */
    public function __construct(string $server, string $licence_username, string $licence_password, string $licence_secret_key = '', array $options = [])
    {
        $this->server = $server;
        $this->licence_username = $licence_username;
        $this->licence_password = $licence_password;
        $this->licence_secret_key = $licence_secret_key;
        $this->post_data = [
            'licence_username' => $this->licence_username,
            'licence_password' => $this->licence_password
        ];
        $this->default_language = $options['default_language'] ?? 'en_EN';
        $this->token = $options['token'] ?? 'sleekshop';
    }

    // *****************************************************************
    // SESSIONS
    // *****************************************************************

    /**
     * Returns a valid session - code which can be used for cart - actions etc...
     *
     * @return string
     */
    public function get_new_session(): string
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
     * @return bool|string An array containing all categories with the parent determined by $id_parent
     */
    public function get_categories(int $id_parent = 0, string $lang = null): bool|string
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
     * @return bool|string The result of the request in JSON format
     */
    public function get_products_in_category(int $id_category = 0, string $lang = null, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): bool|string
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
     * @param string $lang The language to retrieve the contents in
     * @param array $order_columns The columns to order by
     * @param string $order The order (ASC|DESC)
     * @param int $left_limit The left limit of the contents to retrieve
     * @param int $right_limit The right limit of the contents to retrieve
     * @param array $needed_attributes The attributes that should be included in the result
     * @return string The result of the request in JSON format
     */
    public function get_contents_in_category(int $id_category = 0, string $lang = null, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): bool|string
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
     * @param string $lang The language to retrieve the products and contents in
     * @param array $order_columns The columns to order by
     * @param string $order The order (ASC|DESC)
     * @param int $left_limit The left limit of the products and contents to retrieve
     * @param int $right_limit The right limit of the products and contents to retrieve
     * @param array $needed_attributes The attributes that should be included in the result
     * @return string The result of the request in JSON format
     */
    public function get_shopobjects_in_category(int $id_category = 0, string $lang = null, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): bool|string
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
     * @param string $lang The language to retrieve the products and contents in
     * @param array $order_columns The columns to order by
     * @param string $order The order (ASC|DESC)
     * @param int $left_limit The left limit of the products and contents to retrieve
     * @param int $right_limit The right limit of the products and contents to retrieve
     * @param array $needed_attributes The attributes that should be included in the result
     * @return string The result of the request in JSON format
     */
    public function dump_category(int $id_category = 0, string $lang = null, array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): bool|string
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'dump_category';
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
     * Retrieves all products in a given category determined by its permalink
     * @param string $permalink The permalink of the category
     * @param array $order_columns The columns to order by
     * @param string $order The order (ASC|DESC)
     * @param int $left_limit The left limit of the products to retrieve
     * @param int $right_limit The right limit of the products to retrieve
     * @param array $needed_attributes The attributes that should be included in the result
     * @return string The result of the request in JSON format
     */
    public function seo_get_products_in_category(string $permalink = '', array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): bool|string
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'seo_get_products_in_category';
        $post_data['permalink'] = $permalink;
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
     * @return string The result of the request in JSON format
     */
    public function seo_get_contents_in_category(string $permalink = '', array $order_columns = [], string $order = 'ASC', int $left_limit = 0, int $right_limit = 0, array $needed_attributes = []): string
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
     * @return string The result of the request in JSON format
     */
    public function seo_get_shopobjects_in_category(
        string $permalink = '',
        array  $order_columns = [],
        string $order = 'ASC',
        int    $left_limit = 0,
        int    $right_limit = 0,
        array  $needed_attributes = []
    ): string
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
     * @return bool|string The result of the request
     */
    public function create_category($id_parent, $name, $labels, $attributes, $seo): bool|string
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
     * @return bool|string The result of the request
     */
    public function update_category(int $id_category, string $name, array $labels, array $attributes, array $seo): bool|string
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
     * @return bool|string The result of the request
     */
    public function delete_category(int $id_category): bool|string
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
     * @param int $id_class
     * @return bool|string
     */
    public function get_class_details(int $id_class): bool|string
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'get_class_details';
        $post_data['id_class'] = $id_class;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * @param string $name
     * @param string $type
     * @return bool|string
     */
    public function create_class(string $name, string $type): bool|string
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'create_class';
        $post_data['name'] = $name;
        $post_data['type'] = $type;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * @param int $id_class
     * @return bool|string
     */
    public function delete_class(int $id_class): bool|string
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'delete_class';
        $post_data['id_class'] = $id_class;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * @param int $id_class
     * @param array $attributes
     * @return bool|string
     */
    public function create_class_attributes(int $id_class, array $attributes): bool|string
    {
        $post_data = $this->post_data;
        $post_data['licence_secret_key'] = $this->licence_secret_key;
        $post_data['request'] = 'create_class_attributes';
        $post_data['id_class'] = $id_class;
        $post_data['attributes'] = json_encode($attributes);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * @param int $id_class
     * @param array $attributes
     * @return bool|string
     */
    public function delete_class_attributes(int $id_class, array $attributes): bool|string
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
     * Delivers an xml - containing all neccessary - infos of a specific product determined by id_product
     * We also need to deliver the lang
     *
     * @param int $id_product The id of the product
     * @param string|null $lang The language to retrieve the product in
     * @param array $needed_attributes The attributes that should be included in the result
     * @return string The result of the request in XML format
     */
    public function get_product_details(int $id_product = 0, string $lang = null, array $needed_attributes = []): string
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
     * Retrieves product details in XML format for a specific product determined by permalink.
     *
     * @param string $permalink The permalink of the product to retrieve details for.
     * @param array $needed_attributes Optional list of attributes to include in the response.
     *
     * @return mixed The response from the server, containing the product details in XML format.
     */
    public function seo_get_product_details($permalink = '', $needed_attributes = [])
    {
        // Set up the request data
        $post_data = $this->post_data;
        $post_data['request'] = 'seo_get_product_details'; // Set the request type
        $post_data['permalink'] = $permalink; // Set the permalink of the product to retrieve
        $post_data['needed_attributes'] = json_encode($needed_attributes); // Encode the needed attributes as JSON

        // Send the request to the server and return the response
        return $this->snd_request($this->server, $post_data);
    }


    // *****************************************************************
    // CONTENTS
    // *****************************************************************

    /**
     * get_content_details
     *
     * @param int $id_content The id of the content
     * @param string|null $lang The language to retrieve the content in
     * @return string The result of the request in XML format
     */
    public function get_content_details(int $id_content = 0, string $lang = null): bool|string
    {
        $lang = $lang ?? $this->default_language;
        $post_data = $this->post_data;
        $post_data['request'] = 'get_content_details';
        $post_data['language'] = $lang;
        $post_data['id_content'] = $id_content;
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Retrieves content details in XML format for a specific content determined by permalink.
     *
     * @param string $permalink
     * @return bool|string
     */
    public function seo_get_content_details($permalink = ''): bool|string
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'seo_get_content_details';
        $post_data['permalink'] = $permalink;
        return $this->snd_request($this->server, $post_data);
    }

    // *****************************************************************
    // SEARCH
    // *****************************************************************

    // *****************************************************************
    // CART
    // *****************************************************************

    // *****************************************************************
    // USER
    // *****************************************************************

    // *****************************************************************
    // ORDERS
    // *****************************************************************

    // *****************************************************************
    // PAYMENT
    // *****************************************************************

    // *****************************************************************
    // AGGREGATE
    // *****************************************************************

    // *****************************************************************
    // COUPONS
    // *****************************************************************

    // *****************************************************************
    // SERVER
    // *****************************************************************

    // *****************************************************************
    // APPLICATIONS
    // *****************************************************************

    // *****************************************************************
    // WAREHOUSE
    // *****************************************************************

    // *****************************************************************
    // WAREHOUSE
    // *****************************************************************

    // *****************************************************************
    // WEBHOOKS
    // *****************************************************************


    /**
     * Instant login
     * @param string $token The login token
     * @return string The server response
     */
    public function instant_login($token = '')
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'instant_login';
        $post_data['token'] = $token;
        return $this->snd_request($this->server, $post_data);
    }


    /*
     * This function adds a product into the cart determined by the session arg.
     * Further we need to deliver the id_product
     * the quantity
     * the price_field
     * the description_field
     * and the language
     * There also can be added several types of elements - default is product.
     * $id_parent_element determines the parent - element of the inserted element
     * attributes is an array containing assoc - array in the following manner : array("lang"=>"LANG","name"=>"NAME","value"=>"VALUE");
     */
    public function add_to_cart($session = '', $id_product = 0, $quantity = 0, $price_field = '', $name_field = '', $description_field = '', $language = DEFAULT_LANGUAGE, $element_type = 'PRODUCT', $id_parent_element = 0, $attributes = [])
    {
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


    /*
     * This function deletes a piece of a product determined by its element_id from the
     * remote session - cart determined by session
     */
    public function sub_from_cart($session = '', $id_element = 0)
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'sub_from_cart';
        $post_data['session'] = $session;
        $post_data['id_element'] = $id_element;
        return $this->snd_request($this->server, $post_data);
    }


    /*
     * This function delivers the cart and its contents
     */
    public function get_cart($session = '')
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_cart';
        $post_data['session'] = $session;
        return $this->snd_request($this->server, $post_data);
    }


    /*
     * This function sets variable values in the actual session - order
     */
    public function set_order_details($session = '', $args = [])
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

    /*
     * This function gets all delivery countries activated in the backend
     */
    public function get_delivery_countries()
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_delivery_countries';
        return $this->snd_request($this->server, $post_data);
    }

    /*
     * This function returns the actual order-details
     */
    public function get_order_details($session = '')
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_order_details';
        $post_data['session'] = $session;
        return $this->snd_request($this->server, $post_data);
    }


    /*
     * This function checks out the actual cart of the session and creates an order
     */
    public function checkout($session = '')
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'checkout';
        $post_data['session'] = $session;
        return $this->snd_request($this->server, $post_data);
    }

    /*
     * This function returns the available payment - methods
     */
    public function get_payment_methods()
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_payment_methods';
        return ($this->snd_request($this->server, $post_data));
    }


    /*
    * This function inits the payment
    */
    public function do_payment($id_order = 0, $args = [])
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'do_payment';
        $post_data['id_order'] = $id_order;
        $post_data['args'] = json_encode($args);
        return ($this->snd_request($this->server, $post_data));
    }


    /*
     * This function allows us to search in the product - data
     */
    public function search_products($constraint = [], $left_limit = 0, $right_limit = 0, $order_columns = [], $order_type = 'ASC', $lang = DEFAULT_LANGUAGE, $needed_attributes = [])
    {
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

    /*
     * This function allows us to search in the content - data
     */
    public function search_contents($constraint = [], $left_limit = 0, $right_limit = 0, $order_columns = [], $order_type = 'ASC', $lang = DEFAULT_LANGUAGE, $needed_attributes = [])
    {
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

    /*
     * This function allows us to search distinct in the product - data
     */
    public function search_distinct_products($constraint = [], $field = '', $lang = DEFAULT_LANGUAGE)
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'search_distinct_products';
        $i = 0;
        $post_data['constraint'] = json_encode($constraint);
        $post_data['field'] = $field;
        $post_data['language'] = $lang;
        return ($this->snd_request($this->server, $post_data));
    }

    /*
     * This function is for registering a new user
     */
    public function register_user($args = [], $language = DEFAULT_LANGUAGE)
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'register_user';
        $post_data['args'] = json_encode($args);
        $post_data['language'] = $language;
        return ($this->snd_request($this->server, $post_data));
    }

    /*
     * This function resets the user_password
     */
    public function reset_user_password($args = [])
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'reset_user_password';
        $post_data['args'] = json_encode($args);
        return $this->snd_request($this->server, $post_data);
    }

    /*
     * This function is for verifying the user
     */
    public function verify_user($id_user = 0, $session_id = '')
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'verify_user';
        $post_data['id_user'] = $id_user;
        $post_data['session_id'] = $session_id;
        return ($this->snd_request($this->server, $post_data));
    }

    /*
     * This function is for login
     */
    public function login_user($session = '', $username = '', $password = '')
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'login_user';
        $post_data['session'] = $session;
        $post_data['username'] = $username;
        $post_data['password'] = $password;
        return ($this->snd_request($this->server, $post_data));
    }

    /*
     * This function is for logout
     */
    public function logout_user($session = '')
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'logout_user';
        $post_data['session'] = $session;
        return ($this->snd_request($this->server, $post_data));
    }

    /*
   * This function is for setting a new user - password
   */
    public function set_user_password($session, $old_password, $new_password1, $new_password2)
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'set_user_password';
        $post_data['session'] = $session;
        $post_data['old_passwd'] = $old_password;
        $post_data['new_passwd1'] = $new_password1;
        $post_data['new_passwd2'] = $new_password2;
        return ($this->snd_request($this->server, $post_data));
    }


    /*
     * This function delivers the user orders
     */
    public function get_user_orders($session = '')
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_user_orders';
        $post_data['session'] = $session;
        return ($this->snd_request($this->server, $post_data));
    }


    /*
     * This method delivers all user_data available
     */
    public function get_user_data($session = '')
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_user_data';
        $post_data['session'] = $session;
        return ($this->snd_request($this->server, $post_data));
    }

    /*
     * For setting user data
     */
    public function set_user_data($session = '', $args = [])
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'set_user_data';
        $post_data['session'] = $session;
        $post_data['attributes'] = json_encode($args);
        return ($this->snd_request($this->server, $post_data));
    }

    /*
    * This function is for querying the aggregate - request
    */
    public function aggregate($pipe = '')
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'aggregate';
        $post_data['pipe'] = json_encode($pipe);
        return $this->snd_request($this->server, $post_data);
    }

    /*
    * This function is for getting the invoice of an order
    */
    public function get_invoice($id_order = 0)
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_invoice';
        $post_data['id_order'] = $id_order;
        return $this->snd_request($this->server, $post_data);
    }

    /*
     * This function is for getting the order_confirmation of an order
     */
    public function get_order_confirmation($id_order = 0, $args = [])
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'get_order_confirmation';
        $post_data['id_order'] = $id_order;
        $post_data['args'] = json_encode($args);
        return $this->snd_request($this->server, $post_data);
    }

    /*
     * This function adds coupons rows to the cart
     */
    public function add_coupons($session = '', $coupons = [])
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'add_coupons';
        $post_data['session'] = $session;
        $post_data['coupons'] = json_encode($coupons);
        return $this->snd_request($this->server, $post_data);
    }


    /*
     * This function adds deliverycosts rows to the cart permanently
     */
    public function add_delivery_costs($session = '', $delivery_costs = [])
    {
        $post_data = $this->post_data;
        $post_data['request'] = 'add_delivery_costs';
        $post_data['session'] = $session;
        $post_data['delivery_costs'] = json_encode($delivery_costs);
        return $this->snd_request($this->server, $post_data);
    }

    /**
     * Send a POST request to the given URL with the given post data.
     *
     * @param string $url The URL to send the request to
     * @param array $postData The data to send in the request body
     * @param string $userAgent The value to send in the User-Agent header
     * @return bool|string The response from the server, or false on failure
     */
    private function snd_request(string $url, array $postData, string $userAgent = 'PHPPost/1.0'): bool|string
    {
        $ch = curl_init();

        if ($ch === false) {
            echo "Failed to initialize cURL.";
            return false;
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
        if ($response === false) {
            echo "cURL error: " . curl_error($ch);
            curl_close($ch);
            return false;
        }

        curl_close($ch);
        return $response;
    }

}