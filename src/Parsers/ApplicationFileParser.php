<?php

namespace Fidum\LaravelTranslationLinter\Parsers;

use Fidum\LaravelTranslationLinter\Contracts\Parsers\ApplicationFileParser as ApplicationFileParserContract;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\SplFileInfo;

readonly class ApplicationFileParser implements ApplicationFileParserContract
{
    protected const REGEX = '/([FUNCTIONS])\([\t\r\n\s]*[\'"](.+)[\'"][\),\t\r\n\s]/U';

    protected string $pattern;

    public function __construct(array $functions)
    {
        $this->pattern = str_replace('[FUNCTIONS]', implode('|', $functions), static::REGEX);
    }

    public function execute(SplFileInfo $file): Collection
    {
        $data = $file->getContents();
        $collection = new Collection();

        if (! preg_match_all($this->pattern, $data, $matches, PREG_OFFSET_CAPTURE)) {
            // If pattern not found return
            return $collection;
        }

        foreach (current($matches) as $match) {
            preg_match($this->pattern, $match[0], $string);

            $collection->push($string[2]);
        }

        // Remove duplicates.
        return $collection->unique();
    }
}
