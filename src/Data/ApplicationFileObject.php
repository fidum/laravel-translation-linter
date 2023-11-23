<?php

namespace Fidum\LaravelTranslationLinter\Data;

use Symfony\Component\Finder\SplFileInfo;

readonly class ApplicationFileObject
{
    public function __construct(
        public SplFileInfo $file,
        public string $key,
        public ?string $namespaceHint,
        public string $namespaceHintedKey,
    ) {}
}
