<?php

namespace Fidum\LaravelTranslationLinter;

use Fidum\LaravelTranslationLinter\Collections\ApplicationFileCollection;
use Fidum\LaravelTranslationLinter\Collections\MissingFieldCollection;
use Fidum\LaravelTranslationLinter\Collections\MissingFilterCollection;
use Fidum\LaravelTranslationLinter\Collections\ResultObjectCollection;
use Fidum\LaravelTranslationLinter\Collections\UnusedFieldCollection;
use Fidum\LaravelTranslationLinter\Collections\UnusedFilterCollection;
use Fidum\LaravelTranslationLinter\Commands\MissingCommand;
use Fidum\LaravelTranslationLinter\Commands\UnusedCommand;
use Fidum\LaravelTranslationLinter\Contracts\Collections\ApplicationFileCollection as ApplicationFileCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Collections\MissingFieldCollection as MissingFieldCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Collections\MissingFilterCollection as MissingFilterCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Collections\ResultObjectCollection as ResultObjectCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFieldCollection as UnusedFieldCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFilterCollection as UnusedFilterCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Factories\LanguageKeyFactory as LanguageKeyFactoryContract;
use Fidum\LaravelTranslationLinter\Contracts\Factories\LanguageNamespaceKeyFactory as LanguageNamespaceKeyFactoryContract;
use Fidum\LaravelTranslationLinter\Contracts\Finders\ApplicationFileFinder as ApplicationFileFinderContract;
use Fidum\LaravelTranslationLinter\Contracts\Finders\LanguageFileFinder as LanguageFileFinderContract;
use Fidum\LaravelTranslationLinter\Contracts\Finders\LanguageNamespaceFinder as LanguageNamespaceFinderContract;
use Fidum\LaravelTranslationLinter\Contracts\Linters\MissingTranslationLinter as MissingTranslationLinterContract;
use Fidum\LaravelTranslationLinter\Contracts\Linters\UnusedTranslationLinter as UnusedTranslationLinterContract;
use Fidum\LaravelTranslationLinter\Contracts\Parsers\ApplicationFileParser as ApplicationFileParserContract;
use Fidum\LaravelTranslationLinter\Contracts\Readers\ApplicationFileReader as ApplicationFileReaderContract;
use Fidum\LaravelTranslationLinter\Contracts\Readers\LanguageFileReader as LanguageFileReaderContract;
use Fidum\LaravelTranslationLinter\Contracts\Readers\MissingBaselineFileReader as MissingBaselineFileReaderContract;
use Fidum\LaravelTranslationLinter\Contracts\Readers\UnusedBaselineFileReader as UnusedBaselineFileReaderContract;
use Fidum\LaravelTranslationLinter\Contracts\Writers\MissingBaselineFileWriter as MissingBaselineFileWriterContract;
use Fidum\LaravelTranslationLinter\Contracts\Writers\UnusedBaselineFileWriter as UnusedBaselineFileWriterContract;
use Fidum\LaravelTranslationLinter\Factories\LanguageKeyFactory;
use Fidum\LaravelTranslationLinter\Factories\LanguageNamespaceKeyFactory;
use Fidum\LaravelTranslationLinter\Finders\ApplicationFileFinder;
use Fidum\LaravelTranslationLinter\Finders\LanguageFileFinder;
use Fidum\LaravelTranslationLinter\Finders\LanguageNamespaceFinder;
use Fidum\LaravelTranslationLinter\Linters\MissingTranslationLinter;
use Fidum\LaravelTranslationLinter\Linters\UnusedTranslationLinter;
use Fidum\LaravelTranslationLinter\Managers\LanguageFileReaderManager;
use Fidum\LaravelTranslationLinter\Parsers\ApplicationFileParser;
use Fidum\LaravelTranslationLinter\Readers\ApplicationFileReader;
use Fidum\LaravelTranslationLinter\Readers\LanguageFileReader;
use Fidum\LaravelTranslationLinter\Readers\MissingBaselineFileReader;
use Fidum\LaravelTranslationLinter\Readers\UnusedBaselineFileReader;
use Fidum\LaravelTranslationLinter\Writers\MissingBaselineFileWriter;
use Fidum\LaravelTranslationLinter\Writers\UnusedBaselineFileWriter;
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
            ->hasCommand(MissingCommand::class)
            ->hasCommand(UnusedCommand::class);
    }

    public function registeringPackage()
    {
        $this->app->bind(ApplicationFileCollectionContract::class, ApplicationFileCollection::class);

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

        $this->app->when(ApplicationFileParser::class)
            ->needs('$functions')
            ->giveConfig('translation-linter.lang.functions');

        $this->app->bind(LanguageFileFinderContract::class, LanguageFileFinder::class);

        $this->app->bind(LanguageFileReaderContract::class, LanguageFileReader::class);

        $this->app->scoped(LanguageFileReaderManager::class, LanguageFileReaderManager::class);
        $this->app->when(LanguageFileReaderManager::class)
            ->needs('$driverConfig')
            ->giveConfig('translation-linter.lang.readers');

        $this->app->bind(LanguageKeyFactoryContract::class, LanguageKeyFactory::class);

        $this->app->bind(LanguageNamespaceFinderContract::class, LanguageNamespaceFinder::class);

        $this->app->bind(LanguageNamespaceKeyFactoryContract::class, LanguageNamespaceKeyFactory::class);

        $this->app->scoped(MissingBaselineFileReaderContract::class, MissingBaselineFileReader::class);

        $this->app->when(MissingBaselineFileReader::class)
            ->needs('$file')
            ->giveConfig('translation-linter.missing.baseline');

        $this->app->bind(MissingBaselineFileWriterContract::class, MissingBaselineFileWriter::class);

        $this->app->when(MissingBaselineFileWriter::class)
            ->needs('$file')
            ->giveConfig('translation-linter.missing.baseline');

        $this->app->bind(MissingFieldCollectionContract::class, function (Application $app) {
            return MissingFieldCollection::wrap($app->make('config')->get('translation-linter.missing.fields'));
        });

        $this->app->bind(MissingFilterCollectionContract::class, function (Application $app) {
            return MissingFilterCollection::wrap($app->make('config')->get('translation-linter.missing.filters'));
        });

        $this->app->bind(MissingTranslationLinterContract::class, MissingTranslationLinter::class);

        $this->app->when(MissingTranslationLinter::class)
            ->needs('$locales')
            ->giveConfig('translation-linter.lang.locales');

        $this->app->bind(ResultObjectCollectionContract::class, ResultObjectCollection::class);

        $this->app->scoped(UnusedBaselineFileReaderContract::class, UnusedBaselineFileReader::class);

        $this->app->when(UnusedBaselineFileReader::class)
            ->needs('$file')
            ->giveConfig('translation-linter.unused.baseline');

        $this->app->bind(UnusedBaselineFileWriterContract::class, UnusedBaselineFileWriter::class);

        $this->app->when(UnusedBaselineFileWriter::class)
            ->needs('$file')
            ->giveConfig('translation-linter.unused.baseline');

        $this->app->bind(UnusedFieldCollectionContract::class, function (Application $app) {
            return UnusedFieldCollection::wrap($app->make('config')->get('translation-linter.unused.fields'));
        });

        $this->app->bind(UnusedFilterCollectionContract::class, function (Application $app) {
            return UnusedFilterCollection::wrap($app->make('config')->get('translation-linter.unused.filters'));
        });

        $this->app->bind(UnusedTranslationLinterContract::class, UnusedTranslationLinter::class);

        $this->app->when(UnusedTranslationLinter::class)
            ->needs('$locales')
            ->giveConfig('translation-linter.lang.locales');
    }

    public function provides()
    {
        return [
            ApplicationFileCollectionContract::class,
            ApplicationFileFinderContract::class,
            ApplicationFileParserContract::class,
            ApplicationFileReaderContract::class,
            LanguageFileFinderContract::class,
            LanguageFileReaderContract::class,
            LanguageFileReaderManager::class,
            LanguageKeyFactoryContract::class,
            LanguageNamespaceFinderContract::class,
            LanguageNamespaceKeyFactoryContract::class,
            MissingBaselineFileReaderContract::class,
            MissingBaselineFileWriterContract::class,
            MissingFieldCollectionContract::class,
            MissingFilterCollectionContract::class,
            MissingTranslationLinterContract::class,
            ResultObjectCollectionContract::class,
            UnusedBaselineFileReaderContract::class,
            UnusedBaselineFileWriterContract::class,
            UnusedFieldCollectionContract::class,
            UnusedFilterCollectionContract::class,
            UnusedTranslationLinterContract::class,
        ];
    }
}
