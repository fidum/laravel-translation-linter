<?php

namespace Fidum\LaravelTranslationLinter\Collections;

use Illuminate\Support\Collection;

class BaselineCollection extends Collection
{
    public function shouldReport(string $locale, string $key): bool
    {
        $ignoredKeys = $this->get($locale) ?: [];

        if (in_array($key, $ignoredKeys, true)) {
            return false;
        }

        return true;
    }
}
