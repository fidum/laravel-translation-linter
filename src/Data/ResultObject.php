<?php

namespace Fidum\LaravelTranslationLinter\Data;

use Illuminate\Contracts\Support\Arrayable;
use Symfony\Component\Finder\SplFileInfo;

readonly class ResultObject implements Arrayable
{
    public function __construct(
        public SplFileInfo $file,
        public string $key,
        public string $locale,
        public ?string $namespaceHint,
        public string $namespaceHintedKey,
        public ?string $value,
    ) {}

    public function toArray()
    {
        return [
            'locale' => $this->locale,
            'namespace' => $this->namespaceHint,
            'key' => $this->key,
            'value' => $this->value,
        ];
    }
}
