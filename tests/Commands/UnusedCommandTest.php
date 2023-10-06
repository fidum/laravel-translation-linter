<?php

use Illuminate\Support\Facades\Artisan;

use function Pest\Laravel\artisan;
use function Pest\Laravel\withoutMockingConsoleOutput;

it('can test with default filters', function () {
    withoutMockingConsoleOutput();
    artisan('translation:unused');

    expect(Artisan::output())->toMatchSnapshot();
});

it('can test with default no filters', function () {
    config()->set('translation-linter.unused.filters', []);
    withoutMockingConsoleOutput();
    artisan('translation:unused');

    expect(Artisan::output())->toMatchSnapshot();
});

it('can test with default restricted fields', function () {
    config()->set('translation-linter.unused.fields.namespace', false);
    config()->set('translation-linter.unused.fields.value', false);

    withoutMockingConsoleOutput();
    artisan('translation:unused');

    expect(Artisan::output())->toMatchSnapshot();
});

it('can test with default no fields', function () {
    config()->set('translation-linter.unused.fields.locale', false);
    config()->set('translation-linter.unused.fields.namespace', false);
    config()->set('translation-linter.unused.fields.key', false);
    config()->set('translation-linter.unused.fields.value', false);

    withoutMockingConsoleOutput();
    artisan('translation:unused');

    expect(Artisan::output())->toMatchSnapshot();
});
