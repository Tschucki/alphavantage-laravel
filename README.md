# Laravel Wrapper for Alphavantage API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tschucki/alphavantage-laravel.svg?style=flat-square)](https://packagist.org/packages/tschucki/alphavantage-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/tschucki/alphavantage-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tschucki/alphavantage-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/tschucki/alphavantage-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/tschucki/alphavantage-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/tschucki/alphavantage-laravel.svg?style=flat-square)](https://packagist.org/packages/tschucki/alphavantage-laravel)

This Laravel package provides an easy way to access the Alphavantage API. With it, you can i.e. fetch historical financial data, including stock prices, forex, and cryptocurrency information. It integrates smoothly with your Laravel application, making it simple to use Alphavantage's services.

I created this package for a project I was working on. So it currently only supports the categories I needed. If you need more categories, feel free to open an issue or a pull request.
I'd love to hear your feedback and suggestions.

```php
use Tschucki\Alphavantage\Facades\Alphavantage;

Alphavantage::timeSeries()->daily('IBM');
```

## Installation

You can install the package via composer:

```bash
composer require tschucki/alphavantage-laravel
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="alphavantage-laravel-config"
```

This is the contents of the published config file:

```php
return [
    'key' => env('ALPHAVANTAGE_API_KEY'),
];
```
Pay Alphavantage and get your API key [here](https://www.alphavantage.co/support/#api-key).

## Usage

I tried to make the package as easy to use as possible. I tried to follow the [Alphavantage](https://www.alphavantage.co/documentation/) API documentation as closely as possible. So if you are familiar with the API, you should feel right at home.
You have access to the following categories:
- Core
- Fundamentals
- Indicators
- Intelligence

You can either use the facade access these categories or use the `Alphavantage` class directly.

```php
use Tschucki\Alphavantage;

Alphavantage::timeSeries()->daily('IBM');
```

## Documentation

You can find the documentation [here](https://alphavantage-api.marcelwagner.dev/deep-dive/indicators).

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Marcel Wagner](https://github.com/Tschucki)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
