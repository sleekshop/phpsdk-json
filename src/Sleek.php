<?php

/**
 * Sleekshop PHP SDK (https://docs.sleekshop.io)
 *
 */

namespace Sleekshop;

use Sleekshop\Controller\CartCtl;
use Sleekshop\Controller\CategoriesCtl;
use Sleekshop\Controller\PaymentCtl;
use Sleekshop\Controller\ShopobjectsCtl;
use Sleekshop\Controller\SessionCtl;
use Sleekshop\Controller\UserCtl;

class PHPSDK {

    private static $server;
    private static $licence_username;
    private static $licence_password;

    /**
     * @param string $server             The server URL
     * @param string $licence_username   Sleekshop API Licence Username
     * @param string $licence_password   Sleekshop API Licence Password
     */
    public function __construct(string $server, string $licence_username, string $licence_password)
    {
        self::$server = $server;
        self::$licence_username = $licence_username;
        self::$licence_password = $licence_password;
    }

    public static function SleekShopRequest(): SleekShopRequest
    {
        return new SleekShopRequest(self::$server, self::$licence_username, self::$licence_password);
    }

    public static function CartCtl(): CartCtl
    {
        $request = new SleekShopRequest(self::$server, self::$licence_username, self::$licence_password);
        return new CartCtl($request);
    }

    public static function Categories(): CategoriesCtl
    {
        return new CategoriesCtl();
    }

    public static function Payment(): PaymentCtl
    {
        return new PaymentCtl();
    }

    public static function Shopobjects(): ShopobjectsCtl
    {
        return new ShopobjectsCtl();
    }

    public static function Session(): SessionCtl
    {
        return new SessionCtl();
    }

    public static function User(): UserCtl
    {
        return new UserCtl();
    }

}