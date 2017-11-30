# Laravel Api

[![Latest Version on Packagist](https://img.shields.io/packagist/v/elfsundae/laravel-api.svg?style=flat-square)](https://packagist.org/packages/elfsundae/laravel-api)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/ElfSundae/laravel-api/master.svg?style=flat-square)](https://travis-ci.org/ElfSundae/laravel-api)
[![StyleCI](https://styleci.io/repos/94031282/shield)](https://styleci.io/repos/94031282)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/16f19a75-3135-4de0-a3eb-9c1da8f24e64.svg?style=flat-square)](https://insight.sensiolabs.com/projects/16f19a75-3135-4de0-a3eb-9c1da8f24e64)
[![Quality Score](https://img.shields.io/scrutinizer/g/elfsundae/laravel-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/elfsundae/laravel-api)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/elfsundae/laravel-api/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/elfsundae/laravel-api/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/elfsundae/laravel-api.svg?style=flat-square)](https://packagist.org/packages/elfsundae/laravel-api)

## Installation

You can install this package via the [Composer](https://getcomposer.org) manager:

```sh
$ composer require elfsundae/laravel-api
```

Then register the service provider by adding the following to the `providers` array in `config/app.php`:

```php
ElfSundae\Laravel\Api\ApiServiceProvider::class,
```

And publish the config file:

```sh
$ php artisan vendor:publish --tag=laravel-api
```

## Testing

```sh
$ composer test
```

## License

This package is open-sourced software licensed under the [MIT License](LICENSE.md).
