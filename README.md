# Laravel Api

[![Latest Version on Packagist](https://img.shields.io/packagist/v/elfsundae/laravel-api.svg?style=flat-square)](https://packagist.org/packages/elfsundae/laravel-api)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![tests](https://github.com/ElfSundae/laravel-api/actions/workflows/tests.yml/badge.svg)](https://github.com/ElfSundae/laravel-api/actions/workflows/tests.yml)
[![StyleCI](https://styleci.io/repos/94031282/shield)](https://styleci.io/repos/94031282)
[![SymfonyInsight Grade](https://img.shields.io/symfony/i/grade/f4fedeca-30f1-4b19-8b4f-6e8b8782593f?style=flat-square)](https://insight.symfony.com/projects/f4fedeca-30f1-4b19-8b4f-6e8b8782593f)
[![Quality Score](https://img.shields.io/scrutinizer/g/ElfSundae/laravel-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/ElfSundae/laravel-api)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/ElfSundae/laravel-api/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/ElfSundae/laravel-api/?branch=master)
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
