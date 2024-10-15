<?php

// show php errors
ini_set('display_errors', 1);
// hide warnings
error_reporting(E_ERROR);

include 'vendor/autoload.php';

use Sleekshop\sleekSDK;

$sleekshop = new sleekSDK(
    'https://orrpdemo.sleekshop.net/srv/service/',
    'orrpdemo_CoRN8hJmekl4eG8pMU9R',
    'ijvOPDoStEQBIJiN3nY4',
    'QlEXRxkUOTEV5e2xE0zx',
    [
        'token' => 'DEMO',
        'default_language' => 'de_DE',
    ]
);

$session = $sleekshop->SessionCtl()->GetSession();
echo $session;
