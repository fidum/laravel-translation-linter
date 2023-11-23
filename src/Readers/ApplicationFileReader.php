<?php

namespace Fidum\LaravelTranslationLinter\Readers;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ApplicationFileCollection as ApplicationFileCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Finders\ApplicationFileFinder;
use Fidum\LaravelTranslationLinter\Contracts\Parsers\ApplicationFileParser;
use Fidum\LaravelTranslationLinter\Contracts\Readers\ApplicationFileReader as ApplicationFileReaderContract;
use Fidum\LaravelTranslationLinter\Data\ApplicationFileObject;
use Illuminate\Support\Str;

class ApplicationFileReader implements ApplicationFileReaderContract
{
    public function __construct(
        protected ApplicationFileCollectionContract $collection,
        protected ApplicationFileFinder $finder,
        protected ApplicationFileParser $parser,
    ) {}

    public function execute(): ApplicationFileCollectionContract
    {
        // List files
        $files = $this->finder->execute();

        // Get all translatable strings from files
        foreach ($files as $file) {
            foreach ($this->parser->execute($file) as $namespaceHintedKey) {
                $this->collection->push(new ApplicationFileObject(
                    file: $file,
                    key: Str::after($namespaceHintedKey, '::') ?: null,
                    namespaceHint: Str::before($namespaceHintedKey, '::') ?: null,
                    namespaceHintedKey: $namespaceHintedKey,
                ));
            }
        }

        return $this->collection->uniqueForFile();
    }
}
