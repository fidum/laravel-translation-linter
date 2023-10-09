<?php

return [
    'application' => [
        /*
        |--------------------------------------------------------------------------
        | Application Directories
        |--------------------------------------------------------------------------
        |
        | The following array lists the "directories" that will be scanned
        | for translations. The defaults below should cover most uses
        | but if you need to add more make sure they are absolute paths.
        |
        */
        'directories' => [
            app_path(),
            resource_path(),
        ],

        /*
        |--------------------------------------------------------------------------
        | Application File Extensions
        |--------------------------------------------------------------------------
        |
        | The following array lists the file "extensions" that will be scanned for
        | translations. Make sure that all files where you use translations are
        | included here.
        |
        */
        'extensions' => [
            'php',
            'js',
            'vue',
        ],
    ],

    'lang' => [
        /*
        |--------------------------------------------------------------------------
        | Language Functions
        |--------------------------------------------------------------------------
        |
        | The following array lists the translation "functions" that will be used
        | to find translation usage throughout your code. This is injected into
        | a regex pattern we use internally.
        |
        */
        'functions' => [
            '__',
            '_t',
            '@lang',
            '@choice',
            'trans',
            'trans_choice',
            'Lang::choice',
            'Lang::get',
            'Lang::has',
        ],

        /*
        |--------------------------------------------------------------------------
        | Language Locales
        |--------------------------------------------------------------------------
        |
        | The following array contains the "locales" to use when finding all of
        | your registered language files.
        |
        */
        'locales' => [env('LOCALE_DEFAULT', 'en')],

        /*
        |--------------------------------------------------------------------------
        | Language File Readers
        |--------------------------------------------------------------------------
        |
        | The following array lists the language file "readers" that will extract
        | the translations from your language files. This should be mapped as a
        | key value array. The key should be the "extension" and the value
        | should be the "Reader" class that implements the required interface.
        |
        | If you want to disable reading a specific file type then you can
        | remove it from the array below.
        |
        */
        'readers' => [
            'json' => \Fidum\LaravelTranslationLinter\Readers\JsonFileReader::class,
            'php' => \Fidum\LaravelTranslationLinter\Readers\PhpFileReader::class,
        ],
    ],

    'unused' => [
        /*
        |--------------------------------------------------------------------------
        | Baseline file
        |--------------------------------------------------------------------------
        |
        | This is the location of the baseline file that is used to ignore specific
        | translation keys. You can generate this file by using the `--generate-baseline`
        | option when running the command.
        |
        */
        'baseline' => base_path('translations.unused.baseline.json'),

        /*
        |--------------------------------------------------------------------------
        | Output Fields
        |--------------------------------------------------------------------------
        |
        | The following array lists the "fields" that are displayed by the command
        | when unused translations are found. Set any of these to `false` to hide
        | them from the output or change all to `false` to not show anything.
        |
        */
        'fields' => [
            'locale' => true,
            'namespace' => false,
            'key' => true,
            'value' => true,
        ],

        /*
        |--------------------------------------------------------------------------
        | Unused Language Filters
        |--------------------------------------------------------------------------
        |
        | The following array lists the "filters" that will be used to filter out
        | erroneously detected unused translations. For example, you may want to
        | ignore default laravel or vendor translations.
        |
        | All filters must implement the filter interface or they will be skipped:
        | \Fidum\LaravelTranslationLinter\Contracts\Filter
        |
        | We have included some filters with this package which may be of use.
        |
        */
        'filters' => [
            \Fidum\LaravelTranslationLinter\Filters\IgnoreDefaultLanguageFilesFilter::class,
            \Fidum\LaravelTranslationLinter\Filters\IgnoreNamespacedKeysFilter::class,
            \Fidum\LaravelTranslationLinter\Filters\IgnoreVendorKeysFilter::class,
        ],
    ],
];
