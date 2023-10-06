<?php

namespace Fidum\LaravelTranslationLinter\Managers;

use Fidum\LaravelTranslationLinter\Contracts\Readers\LanguageFileReader;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Manager;

/**
 * @method LanguageFileReader driver(string $driver)
 */
class LanguageFileReaderManager extends Manager
{
    public function __construct(
        Container $container,
        protected array $driverConfig,
    ) {
        parent::__construct($container);

        foreach ($this->driverConfig as $driver => $readerClass) {
            $this->extend($driver, fn (Container $app) => $app->get($readerClass));
        }
    }

    public function getDefaultDriver()
    {
        return array_key_first($this->customCreators);
    }

    public function isEnabled(string $driver)
    {
        return array_key_exists($driver, $this->customCreators);
    }

    public function getEnabledDrivers()
    {
        return array_keys($this->customCreators);
    }
}
