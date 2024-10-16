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

    /**
     * @param string $default_language
     * @param string $token
     * @param int $product_image_thumb_height
     */
    public function __construct(
        string $default_language = 'en_EN',
        string $token = 'sleekshop',
        int $product_image_thumb_height = 100,
        string $template_path = __DIR__ . '/templates',
        int $categories_id = 2,
    ) {
        $this->default_language = $default_language;
        $this->token = $token;
        $this->product_image_thumb_height = $product_image_thumb_height;
        $this->template_path = $template_path;
        $this->categories_id = $categories_id;
    }
}