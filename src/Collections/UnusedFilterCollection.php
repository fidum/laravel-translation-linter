<?php

namespace Fidum\LaravelTranslationLinter\Collections;

use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFilterCollection as UnusedFilterCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Filters\Filter;
use Fidum\LaravelTranslationLinter\Data\ResultObject;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Collection;

class UnusedFilterCollection extends Collection implements UnusedFilterCollectionContract
{
    public function shouldReport(ResultObject $object): bool
    {
        return $this->every(function (string $filterClass) use ($object) {
            $interface = Filter::class;

            if (is_subclass_of($filterClass, $interface)) {
                /** @var Filter $filter */
                $filter = app($filterClass);

                return $filter->shouldReport($object);
            }

            throw new InvalidArgumentException("Filter [$filterClass] needs to implement [$interface].");
        });
    }
}
