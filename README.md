# Laravel Translation Linter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fidum/laravel-translation-linter.svg?style=for-the-badge)](https://packagist.org/packages/fidum/laravel-translation-linter)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/fidum/laravel-translation-linter/run-tests.yml?branch=main&label=tests&style=for-the-badge)](https://github.com/fidum/laravel-translation-linter/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/fidum/laravel-translation-linter/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=for-the-badge)](https://github.com/fidum/laravel-translation-linter/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Twitter Follow](https://img.shields.io/badge/follow-%40danmasonmp-1DA1F2?logo=twitter&style=for-the-badge)](https://twitter.com/danmasonmp)

This package provides commands to help you keep your translations organized. 

Shoutout to Hexadog for their package [laravel-translation-manager](https://github.com/hexadog/laravel-translation-manager) 
which was used as the foundation for this package. 

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

## Missing Command
This reads through all your code and finds all your language function usage. 
Then attempts to find matches in your language files and will output any 
keys in your code that do not exist as a language key.

```sh
$ php artisan translation:missing

   ERROR  3 missing translations found.  

+--------+--------------------------------+---------------------+
| Locale | Key                            | File                |
+--------+--------------------------------+---------------------+
| en     | Missing PHP Class              | app/ExampleJson.php |
| en     | Only Missing English PHP Class | app/ExampleJson.php |
| de     | Missing PHP Class              | app/ExampleJson.php |
+--------+--------------------------------+---------------------+
```

You can generate a baseline file which will be used to ignore specific keys with the 
`--generate-baseline` or `-b` command options:

```sh
$ php artisan translation:missing --generate-baseline 

   INFO  Baseline file written with 49 translation keys.  

$ php artisan translation:missing

   INFO  No missing translations found!  
```

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

You can generate a baseline file which will be used to ignore specific keys with the 
`--generate-baseline` or `-b` command options:

```sh
$ php artisan translation:unused --generate-baseline 

   INFO  Baseline file written with 5 unused translation keys.  

$ php artisan translation:unused

   INFO  No unused translations found!  
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
