## Installation

To install the package within your laravel project use the following composer command:

```
composer require hymns/toyyibpay
```


### Publish the Config File

```
php artisan vendor:publish --provider="Hymns\ToyyibPay\ToyyibPayServiceProvider"
```

## Credentials
You are require to have `User Secret Key` before can use this Laravel ToyyibPay package. To get the credential for development on sandbox, you need create an account at [ToyyibPay Staging Portal](https://dev.toyyibpay.com).

### Environment Credential Setup

```BASH
TOYYIBPAY_USER_SECRET_KEY=YOUR_TOYYIBPAY_USER_SECRET_KEY
TOYYIBPAY_REDIRECT_URI=YOUR_TOYYIBPAY_REDIRECT_URI
TOYYIBPAY_PRODUCTION_MODE=YOUR_TOYYIBPAY_PRODUCTION_MODE (TRUE|FALSE)
```

## Auto Discovery

If you're using Laravel 5.5+ you don't need to manually add the service provider or facade. This will be Auto-Discovered. For all versions of Laravel below 5.5, you must manually add the ServiceProvider & Facade to the appropriate arrays within your Laravel project `config/app.php`

### Provider

```php
Hymns\ToyyibPay\ToyyibPayServiceProvider::class,
```

### Alias / Facade

```php
'ToyyibPay' => Hymns\ToyyibPay\ToyyibPayFacade::class,
```

## Usage

### APIs (All Users)

All the APIs writen based on official documentation at [ToyyibPay API Reference](https://toyyibpay.com/apireference/).

#### Use ToyyibPay Facade

```php
use ToyyibPay;

class YourController extends Controller
{
  // Rest of your controller code here...
}
```

#### Create Category

Create collection or category of bills

```php
$response = ToyyibPay::createCategory($name, $description);
var_dump($response);
```

#### Get Category

Get the category or collection information

```php
$response = ToyyibPay::getCategory($category_code);
var_dump($response);
```

### Create Bill

Create bill as an invoice to your customer with ToyyibPay

```php
$response = ToyyibPay::createBill($category_code, [
    'billName' => $request->bill_name,
    'billDescription' => $request->bill_description,
    ...
]);
var_dump($response);
```

#### Get Bill Payment Link

```php
$response = ToyyibPay::billPaymentLink($bill_code);
var_dump($response);
```

### APIs (Enterprise Partner Only)

#### Get Bank

Get Bank API is useful for you to get bank information which are accepted to be used with toyyibPay.

```php
$response = ToyyibPay::getBanks();
var_dump($response);
```

#### Get FPX Bank Code

```php
$response = ToyyibPay::getBanksFPX();
var_dump($response);
```

#### Get Packages

```php
$response = ToyyibPay::getPackages();
var_dump($response);
```

If you have associative array of data set using from ```stdClass``` class that you want to pass into ```ToyyibPay::createBill($category_code, $array)```. Just simply cast it using ```(object)``` as example below.

```php
$response = ToyyibPay::createBill($category_code, (object) $array)
var_dump($response);
```
