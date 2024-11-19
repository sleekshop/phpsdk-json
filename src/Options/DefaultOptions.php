<?php

namespace Sleekshop\Options;

/**
 * Class DefaultOptions
 * @package Sleekshop\Options
 */
class DefaultOptions
{
    public string $default_language;
    public string $token;
    public int $product_image_thumb_height;
    public string $template_path;
    public int $categories_id;
    public array $chaining_field;

    /**
     * @param string $default_language
     * @param string $token
     * @param int $product_image_thumb_height
     * @param string $template_path
     * @param int $categories_id
     * @param array $chaining_field
     */
    public function __construct(
        string $default_language = 'en_EN',
        string $token = 'sleekshop',
        int $product_image_thumb_height = 100,
        string $template_path = __DIR__ . '/templates',
        int $categories_id = 2,
        array $chaining_field = ['class']
    ) {
        $this->default_language = $default_language;
        $this->token = $token;
        $this->product_image_thumb_height = $product_image_thumb_height;
        $this->template_path = $template_path;
        $this->categories_id = $categories_id;
        $this->chaining_field = $chaining_field;
    }
}