<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Readers;

use Illuminate\Support\Collection;

interface ApplicationFileReader
{
    public function execute(): Collection;
}
