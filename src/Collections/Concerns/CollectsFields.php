<?php

namespace Fidum\LaravelTranslationLinter\Collections\Concerns;

use Fidum\LaravelTranslationLinter\Contracts\Collections\FieldCollection as FieldCollectionContract;
use Illuminate\Support\Str;

trait CollectsFields
{
    public function enabled(): FieldCollectionContract
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
