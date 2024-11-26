<?php

namespace Sleekshop\Controller;

use Sleekshop\SleekshopRequest;

class CouponCtl
{

    private SleekshopRequest $request;

    public function __construct(SleekshopRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Adds the specified coupons to the session.
     *
     * @param string $session The session identifier.
     * @param array $coupons An array of coupon codes to add.
     * @return array The result of the add_coupons request.
     */
    public function AddCoupons(string $session = '', array $coupons = []): array
    {
        return $this->request->add_coupons($session, $coupons);
    }

    /**
     * Creates a specified number of coupons with the given name, amount, and type.
     *
     * @param int $count The number of coupons to create. Default is 0.
     * @param string $name The name of the coupons. Default is an empty string.
     * @param float $amount The amount or value of each coupon. Default is 0.
     * @param string $type The type of coupons to create. Default is 'UNIQUE_NOMINAL'.
     * @return array The created coupons.
     */
    public function CreateCoupons(int $count = 0, string $name = '', float $amount = 0, string $type = 'UNIQUE_NOMINAL'): array
    {
        return $this->request->create_coupons($count, $name, $amount, $type);
    }

}