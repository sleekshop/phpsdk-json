<?php

/**
 * Sleekshop PHP SDK (https://docs.sleekshop.io)
 */

namespace Sleekshop;

use JetBrains\PhpStorm\NoReturn;
use Sleekshop\Controller\CartCtl;
use Sleekshop\Controller\CategoriesCtl;
use Sleekshop\Controller\PaymentCtl;
use Sleekshop\Controller\ShopobjectsCtl;
use Sleekshop\Controller\SessionCtl;
use Sleekshop\Controller\UserCtl;

class sleekSDK {

    private string $server;
    private string $licence_username;
    private string $licence_password;
    private string $licence_secret_key;
    private array $options;

    private SleekShopRequest $request;

    /**
     * @param string $server             The server URL
     * @param string $licence_username   Sleekshop API Licence Username
     * @param string $licence_password   Sleekshop API Licence Password
     */
    public function __construct(string $server, string $licence_username, string $licence_password, string $licence_secret_key = '', array $options = [])
    {
        $this->server = $server;
        $this->licence_username = $licence_username;
        $this->licence_password = $licence_password;
        $this->licence_secret_key = $licence_secret_key;
        $this->options = $options;

        $this->request = new SleekShopRequest($this->server, $this->licence_username, $this->licence_password, $this->licence_secret_key, $this->options);
    }

    /**
     * Get a new instance of SleekShopRequest
     *
     * @return SleekShopRequest
     */
    public function SleekShopRequest(): SleekShopRequest
    {
        return new $this->request;
    }

    /**
     * @return CartCtl
     */
    public function CartCtl(): CartCtl
    {
        return new CartCtl($this->request);
    }

    /**
     * Returns a new instance of CategoriesCtl
     *
     * @return CategoriesCtl
     */
    public function CategoriesCtl(): CategoriesCtl
    {
        return new CategoriesCtl(self::$request);
    }

    /**
     * Returns a new instance of PaymentCtl
     *
     * @return PaymentCtl
     */
    public function PaymentCtl(): PaymentCtl
    {
        return new PaymentCtl(self::$request);
    }

    /**
     * Returns a new instance of ShopobjectsCtl
     *
     * @return ShopobjectsCtl
     */
    public function ShopobjectsCtl(): ShopobjectsCtl
    {
        return new ShopobjectsCtl(self::$request);
    }

    /**
     * Returns a new instance of SessionCtl
     *
     * @return SessionCtl
     */
    #[NoReturn] public function SessionCtl(): SessionCtl
    {
        return new SessionCtl($this->request);
    }

    /**
     * Returns a new instance of UserCtl
     *
     * @return UserCtl
     */
    public function UserCtl(): UserCtl
    {
        return new UserCtl(self::$request);
    }

}