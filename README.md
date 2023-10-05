# Checks your code for unused laravel language keys

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fidum/laravel-translation-linter.svg?style=for-the-badge)](https://packagist.org/packages/fidum/laravel-translation-linter)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/fidum/laravel-translation-linter/run-tests.yml?branch=main&label=tests&style=for-the-badge)](https://github.com/fidum/laravel-translation-linter/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/fidum/laravel-translation-linter/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=for-the-badge)](https://github.com/fidum/laravel-translation-linter/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/fidum/laravel-translation-linter.svg?style=for-the-badge)](https://packagist.org/packages/fidum/laravel-translation-linter)
[![Twitter Follow](https://img.shields.io/badge/follow-%40danmasonmp-1DA1F2?logo=twitter&style=for-the-badge)](https://twitter.com/danmasonmp)

## Installation

You can install the package via composer:

```bash
composer require --dev fidum/laravel-translation-linter
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-translation-linter-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$laravelTranslationLinter = new Fidum\LaravelTranslationLinter();
echo $laravelTranslationLinter->echoPhrase('Hello, Fidum!');
```

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

- [Dan Mason](https://github.com/fidum)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
