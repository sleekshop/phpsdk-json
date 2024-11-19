<?php

// show php errors
ini_set('display_errors', 1);
// hide warnings
error_reporting(E_ERROR);

include 'vendor/autoload.php';

use Sleekshop\sleekSDK;
use Sleekshop\Options\DefaultOptions;
use Sleekshop\Options\SessionOptions;

$options = new DefaultOptions(
    'de_DE',
    'sleekshop',
    100,
    '',
    2,
    ['class']
);

$sleekshop = new sleekSDK(
    'https://bestenvergleich.sleekshop.net/srv/service/',
    'bestenvergleich_ate4TXkn3AUhsYBkB3pc',
    '4YJ37ok3aE85KiNzzGwM',
    'zmSdVczMoUi06tqOdC5D',
    $options
);

$sessionOptions = new SessionOptions('none');

try {
//    $req = $sleekshop->CartCtl()->Add("1732038037E4bzdLcl7keR8ghm0y2G0GMU736M3Qty", 6696, 2, 'price', 'name', 'name', 'de_DE', 'PRODUCT_GR', 0, []);
//    $req = $sleekshop->CartCtl()->Del("1732038037E4bzdLcl7keR8ghm0y2G0GMU736M3Qty", 7);
//    $req = $sleekshop->CartCtl()->Clear("1732038037E4bzdLcl7keR8ghm0y2G0GMU736M3Qty");

//    $req = $sleekshop->CategoriesCtl()->GetCategories(2);
    $req = $sleekshop->CategoriesCtl()->GetProductsInCategory(74);
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}
print_r($req);
