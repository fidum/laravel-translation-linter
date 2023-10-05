<?php

return [
    'application' => [
        /*
        |--------------------------------------------------------------------------
        | Code Directories
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
        | Code Extensions
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
        | to find translation usage throughout your code. This is used in the
        | regex pattern below to detect translations.
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
        | Language Function Regex Pattern
        |--------------------------------------------------------------------------
        |
        | The following contains the regex pattern used to find the functions
        | configured above. The '[FUNCTIONS]' part will be replaced with a
        | pipe delimited list of the functions defined above.
        |
        */
        'regex' => '/([FUNCTIONS])\([\t\r\n\s]*[\'"](.+)[\'"][\),\t\r\n\s]/U',

        /*
        |--------------------------------------------------------------------------
        | Language Locales
        |--------------------------------------------------------------------------
        |
        | The following array contains the language 'locales' to use.
        |
        */
        'locales' => [env('LOCALE_DEFAULT', 'en')],
    ],

    'unused' => [
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
            'lang' => true,
            'namespace' => true,
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
        | ignore laravel or vendor translations.
        |
        | All filters must implement the filter interface or they will be skipped:
        | \Fidum\LaravelTranslationLinter\Contracts\Filter
        |
        | We have included some filters with this package which may be of use.
        |
        */
        'filters' => [
            \Fidum\LaravelTranslationLinter\Filters\DefaultLanguageFilesFilter::class,
            \Fidum\LaravelTranslationLinter\Filters\IgnoreNamespacedKeysFilter::class,
        ],
    ],
];
