<?php

namespace Fidum\LaravelTranslationLinter\Collections;

use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFilterCollection as UnusedFilterCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Filters\Filter;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Collection;

class UnusedFilterCollection extends Collection implements UnusedFilterCollectionContract
{
    public function shouldReport(string $lang, string $namespace, string $key, ?string $value): bool
    {
        return $this->every(function (string $filterClass) use ($lang, $namespace, $key, $value) {
            $interface = Filter::class;

            if (is_subclass_of($filterClass, $interface)) {
                /** @var Filter $filter */
                $filter = app($filterClass);

                return $filter->shouldReport($lang, $namespace, $key, $value);
            }

            throw new InvalidArgumentException("Filter [$filterClass] needs to implement [$interface].");
        });
    }
}
