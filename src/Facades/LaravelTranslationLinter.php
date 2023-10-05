<?php

namespace Fidum\LaravelTranslationLinter\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fidum\LaravelTranslationLinter\LaravelTranslationLinter
 */
class LaravelTranslationLinter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fidum\LaravelTranslationLinter\LaravelTranslationLinter::class;
    }
}
