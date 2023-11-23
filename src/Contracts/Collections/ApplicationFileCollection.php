<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Collections;

use Fidum\LaravelTranslationLinter\Data\ApplicationFileObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Enumerable;

/**
 * @method self __construct(ApplicationFileObject[] $items = null)
 * @method self push(ApplicationFileObject $item)
 */
interface ApplicationFileCollection extends Arrayable, Enumerable
{
    public function containsKey(string $key): bool;

    public function doesntContainKey(string $key): bool;
}
