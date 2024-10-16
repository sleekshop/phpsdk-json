<?php

// show php errors
ini_set('display_errors', 1);
// hide warnings
error_reporting(E_ERROR);

include 'vendor/autoload.php';

use Sleekshop\sleekSDK;
use Sleekshop\Options\DefaultOptions;
use Sleekshop\Options\SessionOptions;

$options = new DefaultOptions('de_DE', 'sleekshop', 100);

$sleekshop = new sleekSDK(
    $options
);

$sessionOptions = new SessionOptions('none');

try {
    $session = $sleekshop->CategoriesCtl()->GetContentsInCategory(1);
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}
print_r($session);
