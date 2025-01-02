<?php

/**
 * Sleekshop PHP SDK (https://docs.sleekshop.io)
 */

namespace Sleekshop;

use Sleekshop\Controller\ApplicationCtl;
use Sleekshop\Controller\CartCtl;
use Sleekshop\Controller\CategoriesCtl;
use Sleekshop\Controller\ClassCtl;
use Sleekshop\Controller\CouponCtl;
use Sleekshop\Controller\OrderCtl;
use Sleekshop\Controller\PaymentCtl;
use Sleekshop\Controller\SearchCtl;
use Sleekshop\Controller\ServerCtl;
use Sleekshop\Controller\SessionCtl;
use Sleekshop\Controller\ShopobjectsCtl;
use Sleekshop\Controller\UserCtl;
use Sleekshop\Controller\WarehouseCtl;
use Sleekshop\Controller\WebhookCtl;
use Sleekshop\Options\DefaultOptions;

class sleekSDK {

    private string $server;
    private string $licence_username;
    private string $licence_password;
    private string $licence_secret_key;
    private DefaultOptions $options;

    private SleekshopRequest $request;

    /**
     * Constructor for the sleekshop SDK
     *
     * @param string $server The server URL
     * @param string $licence_username Sleekshop API Licence Username
     * @param string $licence_password Sleekshop API Licence Password
     * @param string $licence_secret_key Sleekshop API Licence Secret Key (optional)
     * @param DefaultOptions|null $options Default options (optional)
     */
    public function __construct(string $server, string $licence_username, string $licence_password, string $licence_secret_key = '', DefaultOptions $options = null)
    {
        $this->server = $server;
        $this->licence_username = $licence_username;
        $this->licence_password = $licence_password;
        $this->licence_secret_key = $licence_secret_key;
        $this->options = $options;

        $this->request = new SleekshopRequest($this->server, $this->licence_username, $this->licence_password, $this->licence_secret_key, $this->options);
    }

    /**
     * Get a new instance of SleekshopRequest
     *
     * @return SleekshopRequest
     */
    public function SleekShopRequest(): SleekshopRequest
    {
        return new $this->request;
    }

    /**
     * @return ApplicationCtl
     */
    public function ApplicationCtl(): ApplicationCtl
    {
        return new ApplicationCtl($this->request);
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
        return new CategoriesCtl($this->request);
    }

    /**
     * Returns a new instance of ClassCtl
     *
     * @return ClassCtl
     */
    public function ClassCtl(): ClassCtl
    {
        return new ClassCtl($this->request);
    }

    /**
     * Returns a new instance of CouponCtl
     *
     * @return CouponCtl
     */
    public function CouponCtl(): CouponCtl
    {
        return new CouponCtl($this->request);
    }

    /**
     * Returns a new instance of OrderCtl
     *
     * @return OrderCtl
     */
    public function OrderCtl(): OrderCtl
    {
        return new OrderCtl($this->request);
    }

    /**
     * Returns a new instance of PaymentCtl
     *
     * @return PaymentCtl
     */
    public function PaymentCtl(): PaymentCtl
    {
        return new PaymentCtl($this->request);
    }

    /**
     * Returns a new instance of SearchCtl
     *
     * @return SearchCtl
     */
    public function SearchCtl(): SearchCtl
    {
        return new SearchCtl($this->request);
    }

    /**
     * Returns a new instance of ServerCtl
     *
     * @return ServerCtl
     */
    public function ServerCtl(): ServerCtl
    {
        return new ServerCtl($this->request);
    }

    /**
     * Returns a new instance of SessionCtl
     *
     * @return SessionCtl
     */
    public function SessionCtl(): SessionCtl
    {
        return new SessionCtl($this->request);
    }

    /**
     * Returns a new instance of ShopobjectsCtl
     *
     * @return ShopobjectsCtl
     */
    public function ShopobjectsCtl(): ShopobjectsCtl
    {
        return new ShopobjectsCtl($this->request);
    }

    /**
     * Returns a new instance of UserCtl
     *
     * @return UserCtl
     */
    public function UserCtl(): UserCtl
    {
        return new UserCtl($this->request);
    }

    /**
     * Returns a new instance of WarehouseCtl
     *
     * @return WarehouseCtl
     */
    public function WarehouseCtl(): WarehouseCtl
    {
        return new WarehouseCtl($this->request);
    }

    /**
     * Returns a new instance of WebhookCtl
     *
     * @return WebhookCtl
     */
    public function WebhookCtl(): WebhookCtl
    {
        return new WebhookCtl($this->request);
    }

}