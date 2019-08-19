# Real.de Onlineshop - API SDK for PHP [![Build Status](https://travis-ci.org/hitmeister/api-sdk-php.svg?branch=develop)](https://travis-ci.org/hitmeister/api-sdk-php)

[![Latest Stable Version](http://img.shields.io/github/release/hitmeister/api-sdk-php.svg)](https://packagist.org/packages/hitmeister/api-sdk)
[![Coverage Status](https://coveralls.io/repos/github/hitmeister/api-sdk-php/badge.svg?branch=master)](https://coveralls.io/github/hitmeister/api-sdk-php?branch=master)
[![Total Downloads](http://img.shields.io/packagist/dt/hitmeister/api-sdk.svg)](https://packagist.org/packages/hitmeister/api-sdk)

PHP client for [Real.de Onlineshop API](https://www.real.de/api/v1/).

## Install

Via Composer

``` bash
$ composer require hitmeister/api-sdk
```

Via GitHub

``` bash
$ git clone git@github.com:hitmeister/api-sdk-php.git
```

## Quickstart

This section will give you a quick overview of the client and how the major functions work.

### Create client

Before starting, you will need the API keys from your [API settings page](https://www.real.de/account/apisettings/).

Include the autoloader in your main project (if you haven’t already), and instantiate a new client.

```php
require 'vendor/autoload.php';

use Hitmeister\Component\Api\ClientBuilder;

$client = ClientBuilder::create()
	->setClientKey('YOUR_CLIENT_KEY')
	->setClientSecret('YOUR_CLIENT_SECRET')
	->build();
```

### Namespaces overview

The client has a number of "namespaces", which generally expose API functionality. The namespaces correspond to the various API endpoints. This is a complete list of namespaces:

| Namespace             | Functionality                                                        |
|-----------------------|----------------------------------------------------------------------|
| `attributes()`        | Retrieve the attributes data                                         |
| `categories()`        | Retrieve the categories data                                         |
| `claimMessages()`     | Post messages to the claim **DEPRECATED**, use `ticketMessages`      |
| `claims()`            | Retrieve and manage the claims **DEPRECATED**, use `tickets`         |
| `importFiles()`       | To send inventory data for multiple items at once                    |
| `items()`             | Retrieve the product data                                            |
| `orders()`            | Retrieve the orders data                                             |
| `orderUnits()`        | Retrieve and manage your order units                                 |
| `productData()`       | Upload or change your product data for an EAN                        |
| `productDataStatus()` | Retrieve the status of your product data                             |
| `reports()`           | Generate and retrieve summary reports                                |
| `returns()`           | Retrieve the returns from your sales                                 |
| `returnUnits()`       | Accept, reject or repair returns from your sales                     |
| `shipments()`         | Add shipment information to order units                              |
| `shippingGroups()`    | Retrieve the shipping groups data                                    |
| `status()`            | System status                                                        |
| `subscriptions()`     | Push notifications management                                        |
| `ticketMessages()`    | Post messages to the tickets                                         |
| `tickets( )`          | Manage tickets, i.e. N-to-N relations between order-units and claims |
| `warehouses()`        | Warehouses management                                                |
| `units()`             | To upload inventory data one item at a time                          |

### Retrieve the categories data

You can search for categories:

```php
$categories = $client->categories()->find('handy');
foreach ($categories as $category) {
	echo "Category ID: {$category->id_category}\n";
	echo "Category Name: {$category->name}\n";
}
```

Or get the information about one of them:

```php
$category = $client->categories()->get(1);
echo "Category ID: {$category->id_category}\n";
echo "Category Name: {$category->name}\n";
```

### Retrieve the product data

Search for items:

```php
$items = $client->items()->find('iphone');
foreach ($items as $item) {
	$eans = implode(',', $item->eans);
	echo "Item ID: {$item->id_item}\n";
	echo "Category ID: {$item->id_category}\n";
	echo "Title: {$item->title}\n";
	echo "EANs: {$eans}\n";
}
```

Also you can find the items by EAN:

```php
$items = $client->items()->findByEan('0885909781652');
```

### Send inventory data

According to the [API documentation](https://www.real.de/api/v1/?page=product-data#uploading-and-updating-items) you have two options:

#### To upload your product data as CSV file

```php
// Post the task to import your file. You will have the ID of the task.
$importFileId = $client->importFiles()
	->post('http://www.example.com/my_products.csv', 'PRODUCT_FEED');

// Retrieve the information about your task
$data = $client->importFiles()->get($importFileId);
echo "URL: {$data->uri}\n";
echo "Status: {$data->status}\n";
```

#### To update a single unit

```php
// $result will be true or false
$result = $client->units()->update(10, ['condition' => 'new']);
```

## Testing

``` bash
$ composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
