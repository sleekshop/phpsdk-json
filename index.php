<?php

include 'vendor/autoload.php';

use Sleekshop\PHPSDK;

$sleekshop = new PHPSDK(
    'https://YOUR-SHOP.sleekshop.net/srv/service/',
    'YOUR-LICENCE-USERNAME',
    'YOUR-LICENCE-PASSWORD'
);

// $sleek->CartCtl()::Add("", "");

$sleekshop->CartCtl()->Add("");

$sleekshop::CartCtl()->Add();