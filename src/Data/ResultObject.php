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
        public ?string $value = null,
    ) {}

    public function toArray()
    {
        return [
            'locale' => $this->locale,
            'key' => $this->namespaceHintedKey,
            'value' => $this->value,
            'file' => str($this->file->getPathname())
                ->replace(base_path(), '')
                ->ltrim(DIRECTORY_SEPARATOR)
                ->toString(),
        ];
    }
}
