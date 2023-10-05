<?php

namespace Fidum\LaravelTranslationLinter\Parsers;

use Fidum\LaravelTranslationLinter\Contracts\Parsers\Parser as ParserContract;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\SplFileInfo;

class Parser implements ParserContract
{
    public function __construct(private string $pattern)
    {
    }

    public function execute(SplFileInfo $file): Collection
    {
        $strings = collect();

        $data = $file->getContents();

        if (! preg_match_all($this->pattern, $data, $matches, PREG_OFFSET_CAPTURE)) {
            // If pattern not found return
            return $strings;
        }

        foreach (current($matches) as $match) {
            preg_match($this->pattern, $match[0], $string);

            $strings->push($string[2]);
        }

        // Remove duplicates.
        return $strings->unique();
    }
}
