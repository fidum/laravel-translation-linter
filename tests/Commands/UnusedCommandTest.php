<?php

use Fidum\LaravelTranslationLinter\Filters\IgnoreKeysFromUnusedBaselineFileFilter;
use Illuminate\Support\Facades\Artisan;

use function Pest\Laravel\artisan;
use function Pest\Laravel\withoutMockingConsoleOutput;

afterEach(function () {
    @unlink(config('translation-linter.unused.baseline'));
});

it('errors with default filters', function () {
    withoutMockingConsoleOutput();
    expect(artisan('translation:unused'))
        ->toBe(1)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});

it('errors with default no filters', function () {
    config()->set('translation-linter.unused.filters', []);

    withoutMockingConsoleOutput();
    expect(artisan('translation:unused "/this/argument/is/ignored" "/and/so/is/this"'))
        ->toBe(1)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});

it('errors with default restricted fields', function () {
    config()->set('translation-linter.unused.fields.value', false);

    withoutMockingConsoleOutput();
    expect(artisan('translation:unused'))
        ->toBe(1)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});

it('errors with default no fields', function () {
    config()->set('translation-linter.unused.fields.locale', false);
    config()->set('translation-linter.unused.fields.key', false);
    config()->set('translation-linter.unused.fields.value', false);

    withoutMockingConsoleOutput();
    expect(artisan('translation:unused'))
        ->toBe(1)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});

it('errors with multiple locales', function () {
    config()->set('translation-linter.lang.locales', ['en', 'de']);
    withoutMockingConsoleOutput();
    expect(artisan('translation:unused'))
        ->toBe(1)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});

it('errors with multiple locales and no filters', function () {
    config()->set('translation-linter.lang.locales', ['en', 'de']);
    config()->set('translation-linter.unused.filters', []);

    withoutMockingConsoleOutput();
    expect(artisan('translation:unused'))
        ->toBe(1)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});

it('generates baseline file then successfully ignores baseline keys', function () {
    config()->set('translation-linter.lang.locales', ['en', 'de']);
    config()->set('translation-linter.unused.filters', [IgnoreKeysFromUnusedBaselineFileFilter::class]);

    withoutMockingConsoleOutput();
    expect(artisan('translation:unused --generate-baseline'))
        ->toBe(0)
        ->and(Artisan::output())
        ->toMatchSnapshot();

    expect($file = config('translation-linter.unused.baseline'))
        ->toBeReadableFile()
        ->and(file_get_contents($file))
        ->toMatchSnapshot();

    expect(artisan('translation:unused'))
        ->toBe(0)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});

it('outputs success message when no unused translations found', function () {
    config()->set('translation-linter.lang.locales', []);
    withoutMockingConsoleOutput();
    expect(artisan('translation:unused'))
        ->toBe(0)
        ->and(Artisan::output())
        ->toMatchSnapshot();
});
