<?php

namespace Fidum\LaravelTranslationLinter\Collections;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ApplicationFileCollection as ApplicationFileCollectionContract;
use Fidum\LaravelTranslationLinter\Data\ApplicationFileObject;
use Illuminate\Support\Collection;

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

    public function uniqueForFile(): ApplicationFileCollectionContract
    {
        return $this->unique(function (ApplicationFileObject $object) {
            return $object->namespaceHintedKey.$object->file->getPathname();
        });
    }
}
