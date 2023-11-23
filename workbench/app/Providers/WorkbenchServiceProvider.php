<?php

namespace Workbench\App\Providers;

use Illuminate\Support\ServiceProvider;

use function Orchestra\Testbench\workbench_path;

class WorkbenchServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(workbench_path('/vendor/example/lang'), 'example');
        $this->loadJsonTranslationsFrom(workbench_path('/vendor/example/lang'));
    }
}
