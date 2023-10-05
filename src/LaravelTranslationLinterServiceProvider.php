<?php

namespace Fidum\LaravelTranslationLinter;

use Fidum\LaravelTranslationLinter\Collections\UnusedFieldCollection;
use Fidum\LaravelTranslationLinter\Collections\UnusedFilterCollection;
use Fidum\LaravelTranslationLinter\Collections\UnusedResultCollection;
use Fidum\LaravelTranslationLinter\Commands\UnusedCommand;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFieldCollection as UnusedFieldCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFilterCollection as UnusedFilterCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedResultCollection as UnusedResultCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Extractors\Extractor as ExtractorContract;
use Fidum\LaravelTranslationLinter\Contracts\Finders\ApplicationFileFinder as ApplicationFileFinderContract;
use Fidum\LaravelTranslationLinter\Contracts\Finders\LanguageFileFinder as LanguageFileFinderContract;
use Fidum\LaravelTranslationLinter\Contracts\Finders\LanguageNamespaceFinder as LanguageNamespaceFinderContract;
use Fidum\LaravelTranslationLinter\Contracts\Linters\UnusedTranslationLinter as UnusedTranslationLinterContract;
use Fidum\LaravelTranslationLinter\Contracts\Parsers\Parser as ParserContract;
use Fidum\LaravelTranslationLinter\Extractors\Extractor;
use Fidum\LaravelTranslationLinter\Finders\ApplicationFileFinder;
use Fidum\LaravelTranslationLinter\Finders\LanguageFileFinder;
use Fidum\LaravelTranslationLinter\Finders\LanguageNamespaceFinder;
use Fidum\LaravelTranslationLinter\Linters\UnusedTranslationLinter;
use Fidum\LaravelTranslationLinter\Parsers\Parser;
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
        $this->app->bind(ApplicationFileFinderContract::class, function (Application $app) {
            return new ApplicationFileFinder(
                $app->make('files'),
                $app->make('config')->get('translation-linter.application.directories'),
                $app->make('config')->get('translation-linter.application.extensions'),
            );
        });

        $this->app->bind(ExtractorContract::class, Extractor::class);
        $this->app->bind(LanguageFileFinderContract::class, LanguageFileFinder::class);
        $this->app->bind(LanguageNamespaceFinderContract::class, LanguageNamespaceFinder::class);

        $this->app->bind(ParserContract::class, function (Application $app) {
            $regex = $app->make('config')->get('translation-linter.lang.regex');
            $functions = $app->make('config')->get('translation-linter.lang.functions');

            return new Parser(str_replace('[FUNCTIONS]', implode('|', $functions), $regex));
        });

        $this->app->bind(UnusedFieldCollectionContract::class, function (Application $app) {
            return UnusedFieldCollection::wrap($app->make('config')->get('translation-linter.unused.fields'));
        });

        $this->app->bind(UnusedFilterCollectionContract::class, function (Application $app) {
            return UnusedFilterCollection::wrap($app->make('config')->get('translation-linter.unused.filters'));
        });

        $this->app->bind(UnusedResultCollectionContract::class, UnusedResultCollection::class);
        $this->app->bind(UnusedTranslationLinterContract::class, UnusedTranslationLinter::class);
    }

    public function provides()
    {
        return [
            ApplicationFileFinderContract::class,
            ExtractorContract::class,
            LanguageFileFinderContract::class,
            LanguageNamespaceFinderContract::class,
            ParserContract::class,
            UnusedFieldCollectionContract::class,
            UnusedFilterCollectionContract::class,
            UnusedResultCollectionContract::class,
            UnusedTranslationLinterContract::class,
        ];
    }
}
