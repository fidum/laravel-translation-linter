<?php

namespace Fidum\LaravelTranslationLinter\Commands;

use Illuminate\Console\Command;

class LaravelTranslationLinterCommand extends Command
{
    public $signature = 'laravel-translation-linter';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
