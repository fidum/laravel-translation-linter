# Laravel Translation Linter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fidum/laravel-translation-linter.svg?style=for-the-badge)](https://packagist.org/packages/fidum/laravel-translation-linter)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/fidum/laravel-translation-linter/run-tests.yml?branch=main&label=tests&style=for-the-badge)](https://github.com/fidum/laravel-translation-linter/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/fidum/laravel-translation-linter/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=for-the-badge)](https://github.com/fidum/laravel-translation-linter/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/fidum/laravel-translation-linter.svg?style=for-the-badge)](https://packagist.org/packages/fidum/laravel-translation-linter)
[![Twitter Follow](https://img.shields.io/badge/follow-%40danmasonmp-1DA1F2?logo=twitter&style=for-the-badge)](https://twitter.com/danmasonmp)

This package provides commands to help you keep your translations organized. 

Shoutout to Hexadog for their package [laravel-translation-manager](https://github.com/hexadog/laravel-translation-manager) 
which was used as the foundation for this package. 

Here is the feature list / roadmap for this package:

- [x] Supports JSON and PHP translation files
  - You can enable / disable file types in the config
  - You can add your own custom file readers 
- [x] Supports multiple locales
- [x] Supports parsing many code types 
  - Default: php, js and vue
  - You can add more file extensions in the config
- [x] [Unused Command](#unused-command)
- [ ] Missing Command - _coming soon_
- [ ] Orphaned Command - _coming soon_
- [ ] Lint Command - _coming soon_
  - This would run all of the other commands in a single command.

## Installation

You can install the package via composer:

```bash
composer require --dev fidum/laravel-translation-linter
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="translation-linter-config"
```

[Click here to see the contents of the config file](config/translation-linter.php).

You should read through the config, which serves as additional documentation and make changes as needed.

## Unused Command
This reads through all your code and finds all your language function usage. 
Then attempts to find matches in your language files and will output any 
language keys that are not being used in your code.

**Note:** Some language keys are filtered out by default, you can change the 
filters used in the [config file](config/translation-linter.php).

```sh
$ php artisan translation:unused

   ERROR  5 unused translations found.  

+--------+----------------------+-----------------------------------------------+
| Locale | Key                  | Value                                         |
+--------+----------------------+-----------------------------------------------+
| en     | Unused PHP Class     | I am unused in php class                      |
| en     | Unused Blade File    | I am unused in blade                          |
| en     | Unused Vue Component | I am unused in vue component                  |
| en     | example.unused       | I am unused in php class                      |
| de     | example.unused       | Ich werde in einer PHP-Klasse nicht verwendet |
+--------+----------------------+-----------------------------------------------+
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
