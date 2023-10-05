<?php

namespace Fidum\LaravelTranslationLinter;

use Fidum\LaravelTranslationLinter\Commands\LaravelTranslationLinterCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelTranslationLinterServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-translation-linter')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-translation-linter_table')
            ->hasCommand(LaravelTranslationLinterCommand::class);
    }
}
