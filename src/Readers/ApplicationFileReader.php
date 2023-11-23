<?php

namespace Fidum\LaravelTranslationLinter\Readers;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ApplicationFileCollection as ApplicationFileCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Finders\ApplicationFileFinder;
use Fidum\LaravelTranslationLinter\Contracts\Parsers\ApplicationFileParser;
use Fidum\LaravelTranslationLinter\Contracts\Readers\ApplicationFileReader as ApplicationFileReaderContract;
use Fidum\LaravelTranslationLinter\Data\ApplicationFileObject;

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
            $this->collection->push(...$this->parser->execute($file));
        }

        return $this->collection->unique(function (ApplicationFileObject $object) {
            return $object->namespaceHintedKey.$object->file->getPathname();
        });
    }
}
