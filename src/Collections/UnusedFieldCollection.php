<?php

namespace Fidum\LaravelTranslationLinter\Collections;

use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFieldCollection as UnusedFieldCollectionContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class UnusedFieldCollection extends Collection implements UnusedFieldCollectionContract
{
    public function enabled(): static
    {
        return $this->filter()->keys();
    }

    public function headers(): array
    {
        return $this->enabled()
            ->map(fn ($v) => Str::headline($v))
            ->toArray();
    }
}
