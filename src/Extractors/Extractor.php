<?php

namespace Fidum\LaravelTranslationLinter\Extractors;

use Fidum\LaravelTranslationLinter\Contracts\Extractors\Extractor as ExtractorContract;
use Fidum\LaravelTranslationLinter\Contracts\Finders\ApplicationFileFinder;
use Fidum\LaravelTranslationLinter\Contracts\Parsers\Parser;
use Illuminate\Support\Collection;

class Extractor implements ExtractorContract
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
