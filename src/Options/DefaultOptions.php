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
    public string $chaining_field;

    /**
     * @param string $default_language
     * @param string $token
     * @param int $product_image_thumb_height
     * @param string $chaining_field
     */
    public function __construct(
        string $default_language = 'en_EN',
        string $token = 'sleekshop',
        int $product_image_thumb_height = 100,
        string $chaining_field = 'class'
    ) {
        $this->default_language = $default_language;
        $this->token = $token;
        $this->product_image_thumb_height = $product_image_thumb_height;
        $this->chaining_field = $chaining_field;
    }
}