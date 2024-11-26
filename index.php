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
    '', // needs values to work
    $options
);

$sessionOptions = new SessionOptions('none');

try {
//    $req = $sleekshop->CartCtl()->Add("1732038037E4bzdLcl7keR8ghm0y2G0GMU736M3Qty", 6696, 2, 'price', 'name', 'name', 'de_DE', 'PRODUCT_GR', 0, []);
//    $req = $sleekshop->CartCtl()->Del("1732038037E4bzdLcl7keR8ghm0y2G0GMU736M3Qty", 7);
//    $req = $sleekshop->CartCtl()->Clear("1732038037E4bzdLcl7keR8ghm0y2G0GMU736M3Qty");

//    $req = $sleekshop->CategoriesCtl()->GetCategories(2);
//    $req = $sleekshop->CategoriesCtl()->GetProductsInCategory(74);
//    $req = $sleekshop->CategoriesCtl()->GetContentsInCategory(1);
//    $req = $sleekshop->CategoriesCtl()->GetContentsInCategory(1);

//    $req = $sleekshop->PaymentCtl()->GetPaymentMethods();

    $req = $sleekshop->ShopobjectsCtl()->GetShopobjects(1);
//    $req = $sleekshop->ShopobjectsCtl()->SeoGetShopobjects('start');
//    $req = $sleekshop->ShopobjectsCtl()->GetProductDetails(6696);
//    $req = $sleekshop->ShopobjectsCtl()->GetContentDetails(1231223213);
//    $req = $sleekshop->ShopobjectsCtl()->SeoGetProductDetails('2111313319');
//    $req = $sleekshop->ShopobjectsCtl()->SeoGetContentDetails('imprint');
//    $req = $sleekshop->ShopobjectsCtl()->SearchProducts(['main.name' => ['LIKE', '2111313319']]);

//    $req = $sleekshop->UserCtl()->GetUserById(1);

//    $req = $sleekshop->ApplicationCtl()->ApplicationApiCall('asd', 'test', ['test' => 'test']);

//    $req = $sleekshop->SearchCtl()->SearchProducts(['main.class' => ['LIKE', 'product']]);
//    $req = $sleekshop->SearchCtl()->SearchContents(['main.name' => ['LIKE', 'a']]);
//    $req = $sleekshop->SearchCtl()->SearchDistinctProducts(['main.name' => ['LIKE', 'a']], 'name', 'de_DE');

//    $req = $sleekshop->ServerCtl()->GetStatus();

} catch (Exception $e) {
    echo $e->getMessage();
    die();
}
print_r($req);
