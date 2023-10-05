<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Linters;

use Illuminate\Support\Collection;

interface UnusedTranslationLinter
{
    public function execute(): Collection;
}
