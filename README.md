# Sleekshop phpsdk-json 2.0

This is the official Sleekshop PHP SDK for the Sleekshop API. It is a wrapper around the Sleekshop API, which provides a simple way to interact with the API.

> Sleekshop is a cloudbased e-commerce platform which allows you to deploy e-commerce functionality via API into your projects no matter what kind of programming - language you want to use, or which devices you want to address.

More about Sleekshop can be found at https://www.sleekshop.io

## Documentation

For more information about the Sleekshop API, please refer to the [official documentation](https://docs.sleekshop.io/).

## Installation

### Using composer

```
composer require sleekcommerce/sleekshop-phpsdk-json:v2.0.0
```

## Usage

### 1. Setup SDK

```php
include 'vendor/autoload.php';

use Sleekshop\sleekSDK;
use Sleekshop\Options\DefaultOptions; // optional

$defaultOptions = new DefaultOptions('en_EN', 'sleekshop', 100); // optional

$sleekshop = new sleekSDK(
    'https://<yourInstance>.sleekshop.net/srv/service/',
    '<licence_username>',
    '<licence_password>',
    '<licence_secret_key>', // optional but required for some operations
    $defaultOptions // optional
);
```

### 2. Interact with the API

```php
$session = $sleekshop->SessionCtl()->GetSession();
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.