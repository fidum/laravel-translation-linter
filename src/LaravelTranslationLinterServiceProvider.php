<?php

namespace Fidum\LaravelTranslationLinter;

use Fidum\LaravelTranslationLinter\Collections\UnusedFieldCollection;
use Fidum\LaravelTranslationLinter\Collections\UnusedFilterCollection;
use Fidum\LaravelTranslationLinter\Collections\UnusedResultCollection;
use Fidum\LaravelTranslationLinter\Commands\UnusedCommand;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFieldCollection as UnusedFieldCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFilterCollection as UnusedFilterCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedResultCollection as UnusedResultCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Finders\ApplicationFileFinder as ApplicationFileFinderContract;
use Fidum\LaravelTranslationLinter\Contracts\Finders\LanguageFileFinder as LanguageFileFinderContract;
use Fidum\LaravelTranslationLinter\Contracts\Finders\LanguageNamespaceFinder as LanguageNamespaceFinderContract;
use Fidum\LaravelTranslationLinter\Contracts\Linters\UnusedTranslationLinter as UnusedTranslationLinterContract;
use Fidum\LaravelTranslationLinter\Contracts\Parsers\ApplicationFileParser as ApplicationFileParserContract;
use Fidum\LaravelTranslationLinter\Contracts\Readers\ApplicationFileReader as ApplicationFileReaderContract;
use Fidum\LaravelTranslationLinter\Contracts\Readers\LanguageFileReader as LanguageFileReaderContract;
use Fidum\LaravelTranslationLinter\Finders\ApplicationFileFinder;
use Fidum\LaravelTranslationLinter\Finders\LanguageFileFinder;
use Fidum\LaravelTranslationLinter\Finders\LanguageNamespaceFinder;
use Fidum\LaravelTranslationLinter\Linters\UnusedTranslationLinter;
use Fidum\LaravelTranslationLinter\Parsers\ApplicationFileParser;
use Fidum\LaravelTranslationLinter\Readers\ApplicationFileReader;
use Fidum\LaravelTranslationLinter\Readers\LanguageFileReader;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelTranslationLinterServiceProvider extends PackageServiceProvider implements DeferrableProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-translation-linter')
            ->hasConfigFile()
            ->hasCommand(UnusedCommand::class);
    }

    public function registeringPackage()
    {
        $this->app->bind(ApplicationFileFinderContract::class, ApplicationFileFinder::class);

        $this->app->when(ApplicationFileFinder::class)
            ->needs('$directories')
            ->giveConfig('translation-linter.application.directories');

        $this->app->when(ApplicationFileFinder::class)
            ->needs('$extensions')
            ->giveConfig('translation-linter.application.extensions');

        $this->app->bind(ApplicationFileParserContract::class, ApplicationFileParser::class);

        $this->app->when(ApplicationFileParser::class)
            ->needs('$functions')
            ->giveConfig('translation-linter.lang.functions');

        $this->app->bind(ApplicationFileReaderContract::class, ApplicationFileReader::class);

        $this->app->bind(LanguageFileFinderContract::class, LanguageFileFinder::class);

        $this->app->bind(LanguageFileReaderContract::class, LanguageFileReader::class);

        $this->app->bind(LanguageNamespaceFinderContract::class, LanguageNamespaceFinder::class);

        $this->app->bind(UnusedFieldCollectionContract::class, function (Application $app) {
            return UnusedFieldCollection::wrap($app->make('config')->get('translation-linter.unused.fields'));
        });

        $this->app->bind(UnusedFilterCollectionContract::class, function (Application $app) {
            return UnusedFilterCollection::wrap($app->make('config')->get('translation-linter.unused.filters'));
        });

        $this->app->bind(UnusedResultCollectionContract::class, UnusedResultCollection::class);

        $this->app->bind(UnusedTranslationLinterContract::class, UnusedTranslationLinter::class);

        $this->app->when(UnusedTranslationLinter::class)
            ->needs('$locales')
            ->giveConfig('translation-linter.lang.locales');
    }

    public function provides()
    {
        return [
            ApplicationFileFinderContract::class,
            ApplicationFileParserContract::class,
            ApplicationFileReaderContract::class,
            LanguageFileFinderContract::class,
            LanguageFileReaderContract::class,
            LanguageNamespaceFinderContract::class,
            UnusedFieldCollectionContract::class,
            UnusedFilterCollectionContract::class,
            UnusedResultCollectionContract::class,
            UnusedTranslationLinterContract::class,
        ];
    }
}
