<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Finders;

use Illuminate\Support\Collection;

interface Finder
{
    public function execute(): Collection;
}
