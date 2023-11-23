<?php

namespace Fidum\LaravelTranslationLinter\Parsers;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ApplicationFileCollection as ApplicationFileCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Parsers\ApplicationFileParser as ApplicationFileParserContract;
use Fidum\LaravelTranslationLinter\Data\ApplicationFileObject;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

readonly class ApplicationFileParser implements ApplicationFileParserContract
{
    protected const REGEX = '/([FUNCTIONS])\([\t\r\n\s]*[\'"](.+)[\'"][\),\t\r\n\s]/U';

    protected string $pattern;

    public function __construct(
        protected ApplicationFileCollectionContract $collection,
        array $functions
    ) {
        $this->pattern = str_replace('[FUNCTIONS]', implode('|', $functions), static::REGEX);
    }

    public function execute(SplFileInfo $file): ApplicationFileCollectionContract
    {
        $data = $file->getContents();

        if (! preg_match_all($this->pattern, $data, $matches, PREG_OFFSET_CAPTURE)) {
            // If pattern not found return
            return $this->collection;
        }

        foreach (current($matches) as $match) {
            preg_match($this->pattern, $match[0], $string);

            $namespaceHintedKey = $string[2];

            $this->collection->push(new ApplicationFileObject(
                file: $file,
                key: Str::after($namespaceHintedKey, '::') ?: null,
                namespaceHint: Str::before($namespaceHintedKey, '::') ?: null,
                namespaceHintedKey: $namespaceHintedKey,
            ));
        }

        // Remove duplicates.
        return $this->collection->unique(function (ApplicationFileObject $object) {
            return $object->namespaceHintedKey;
        });
    }
}
