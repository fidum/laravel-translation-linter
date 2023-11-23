<?php

use Illuminate\Support\Facades\Artisan;

use function Orchestra\Testbench\workbench_path;
use function Pest\Laravel\artisan;
use function Pest\Laravel\withoutMockingConsoleOutput;

afterEach(function () {
    @unlink(config('translation-linter.missing.baseline'));
});

it('errors with default config', function () {
    withoutMockingConsoleOutput();
    expect(artisan('translation:missing'))
        ->toBe(1)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});

it('errors with paths argument', function () {
    config()->set('translation-linter.missing.filters', []);
    $firstFile = workbench_path('app/Example.php');
    $secondFile = resource_path('js/MissingComponent.vue');

    withoutMockingConsoleOutput();
    expect(artisan("translation:missing \"$firstFile\" \"$secondFile\" \"/this/does/not/exist\""))
        ->toBe(1)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});

it('errors with different fields', function () {
    config()->set('translation-linter.missing.fields.locale', false);

    withoutMockingConsoleOutput();
    expect(artisan('translation:missing'))
        ->toBe(1)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});

it('errors with default no fields', function () {
    config()->set('translation-linter.missing.fields.locale', false);
    config()->set('translation-linter.missing.fields.key', false);
    config()->set('translation-linter.missing.fields.file', false);

    withoutMockingConsoleOutput();
    expect(artisan('translation:missing'))
        // ->toBe(1)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});

it('errors with multiple locales', function () {
    config()->set('translation-linter.lang.locales', ['en', 'de']);
    $firstFile = workbench_path('app/ExampleJson.php');

    withoutMockingConsoleOutput();
    expect(artisan("translation:missing \"$firstFile\""))
        ->toBe(1)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});

it('generates baseline file then successfully ignores baseline keys', function () {
    config()->set('translation-linter.lang.locales', ['en', 'de']);

    withoutMockingConsoleOutput();
    expect(artisan('translation:missing --generate-baseline'))
        ->toBe(0)
        ->and(Artisan::output())
        ->toMatchSnapshot();

    expect($file = config('translation-linter.missing.baseline'))
        ->toBeReadableFile()
        ->and(file_get_contents($file))
        ->toMatchSnapshot();

    expect(artisan('translation:missing'))
        ->toBe(0)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});

it('outputs success message when no missing translations found', function () {
    config()->set('translation-linter.lang.locales', []);
    withoutMockingConsoleOutput();
    expect(artisan('translation:missing'))
        ->toBe(0)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});
