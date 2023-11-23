<?php

namespace Fidum\LaravelTranslationLinter\Collections;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ApplicationFileCollection as ApplicationFileCollectionContract;
use Fidum\LaravelTranslationLinter\Data\ApplicationFileObject;
use Illuminate\Support\Collection;

/**
 * @method self __construct(ApplicationFileObject[] $items = null)
 * @method self push(ApplicationFileObject $object)
 */
class ApplicationFileCollection extends Collection implements ApplicationFileCollectionContract
{
    public function containsKey(string $key): bool
    {
        return $this->some(function (ApplicationFileObject $object) use ($key) {
            return $object->namespaceHintedKey === $key;
        });
    }

    public function doesntContainKey(string $key): bool
    {
        return ! $this->containsKey($key);
    }
}
