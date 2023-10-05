<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Extractors;

use Illuminate\Support\Collection;

interface Extractor
{
    public function execute(): Collection;
}
