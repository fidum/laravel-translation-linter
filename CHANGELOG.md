# Changelog

All notable changes to `laravel-translation-linter` will be documented in this file.

## 3.0.0 - 2025-02-24

### What's Changed

* Run tests on PHP 8.4 by @dmason30 in https://github.com/fidum/laravel-translation-linter/pull/22
* Adds Laravel 12.x Support by @dmason30 in https://github.com/fidum/laravel-translation-linter/pull/24
* Drops Laravel 10.x Support

**Full Changelog**: https://github.com/fidum/laravel-translation-linter/compare/2.0.3...3.0.0

## 2.0.3 - 2024-03-05

### What's Changed

* Run tests on PHP 8.3 by @dmason30 in https://github.com/fidum/laravel-translation-linter/pull/13
* Bump aglipanci/laravel-pint-action from 2.3.0 to 2.3.1 by @dependabot in https://github.com/fidum/laravel-translation-linter/pull/14
* Bump ramsey/composer-install from 2 to 3 by @dependabot in https://github.com/fidum/laravel-translation-linter/pull/15
* Support Laravel 11 by @dmason30 in https://github.com/fidum/laravel-translation-linter/pull/16

**Full Changelog**: https://github.com/fidum/laravel-translation-linter/compare/2.0.2...2.0.3

## 2.0.2 - 2023-11-23

### What's Changed

- Fix performance issue and baseline key count by @dmason30 in https://github.com/fidum/laravel-translation-linter/pull/12

**Full Changelog**: https://github.com/fidum/laravel-translation-linter/compare/2.0.1...2.0.2

## 2.0.1 - 2023-11-23

### What's Changed

- Separate locales config for each command by @dmason30 in https://github.com/fidum/laravel-translation-linter/pull/11
  - Config `transliation-linter` field `lang.locales` has been removed.
  - Replace with separate `missing.locales` and `unused.locales`.
  

**Full Changelog**: https://github.com/fidum/laravel-translation-linter/compare/2.0.0...2.0.1

## 2.0.0 - 2023-11-23

### What's Changed

- Adds command to find missing translations by @dmason30 in https://github.com/fidum/laravel-translation-linter/pull/10
  - The `translation-linter` config has had major changes please delete it and re publish it using the instructions on the readme.
  

**Full Changelog**: https://github.com/fidum/laravel-translation-linter/compare/1.0.6...2.0.0

## 1.0.6 - 2023-11-22

### What's Changed

- Always use unused namespace key in output by @dmason30 in https://github.com/fidum/laravel-translation-linter/pull/9
  - The config value `translation-linter.unused.fields.namespace` has been removed.
  

**Full Changelog**: https://github.com/fidum/laravel-translation-linter/compare/1.0.5...1.0.6

## 1.0.5 - 2023-10-11

### What's Changed

- Add support for lint-staged by @dmason30 in https://github.com/fidum/laravel-translation-linter/pull/8

**Full Changelog**: https://github.com/fidum/laravel-translation-linter/compare/1.0.4...1.0.5

## 1.0.4 - 2023-10-09

### What's Changed

- Bump stefanzweifel/git-auto-commit-action from 4 to 5 by @dependabot in https://github.com/fidum/laravel-translation-linter/pull/6
- Create missing baseline directories by @dmason30 in https://github.com/fidum/laravel-translation-linter/pull/7

**Full Changelog**: https://github.com/fidum/laravel-translation-linter/compare/1.0.3...1.0.4

## 1.0.3 - 2023-10-09

### What's Changed

- Add support for generating a baseline file by @dmason30 in https://github.com/fidum/laravel-translation-linter/pull/5

**Full Changelog**: https://github.com/fidum/laravel-translation-linter/compare/1.0.2...1.0.3

## 1.0.2 - 2023-10-09

### What's Changed

- Handle namespaced json files by @dmason30 in https://github.com/fidum/laravel-translation-linter/pull/4

**Full Changelog**: https://github.com/fidum/laravel-translation-linter/compare/1.0.1...1.0.2

## 1.0.1 - 2023-10-07

#### What's Changed

- Refactor language key generation (https://github.com/fidum/laravel-translation-linter/commit/34ec4eda2d2f2dc04013a600d3cbb29c2890ac86)

**Full Changelog**: https://github.com/fidum/laravel-translation-linter/compare/1.0.0...1.0.1

## 1.0.0 - 2023-10-06

### What's Changed

- Initial Release
