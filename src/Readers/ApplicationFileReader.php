<?php

namespace Fidum\LaravelTranslationLinter\Readers;

use Fidum\LaravelTranslationLinter\Contracts\Finders\ApplicationFileFinder;
use Fidum\LaravelTranslationLinter\Contracts\Parsers\Parser;
use Fidum\LaravelTranslationLinter\Contracts\Readers\ApplicationFileReader as ApplicationFileReaderContract;
use Illuminate\Support\Collection;

class ApplicationFileReader implements ApplicationFileReaderContract
{
    public function __construct(
        protected ApplicationFileFinder $finder,
        protected Parser $parser,
    ) {
    }

    public function execute(): Collection
    {
        $strings = new Collection();

        // List files
        $files = $this->finder->execute();

        // Get all translatable strings from files
        foreach ($files as $file) {
            $strings = $strings->merge($this->parser->execute($file));
        }

        return $strings->unique();
    }
}
