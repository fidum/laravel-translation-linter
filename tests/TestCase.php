<?php

namespace Fidum\LaravelTranslationLinter\Tests;

use Fidum\LaravelTranslationLinter\LaravelTranslationLinterServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Workbench\App\Providers\WorkbenchServiceProvider;

use function Orchestra\Testbench\workbench_path;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelTranslationLinterServiceProvider::class,
            WorkbenchServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app->setBasePath(workbench_path());
    }
}
