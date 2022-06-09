<?php

namespace FmTod\LaravelTabulator;

use FmTod\LaravelTabulator\Commands\LaravelTabulatorMakeCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelTabulatorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-tabulator')
            ->hasConfigFile()
            ->hasViews()
            ->hasCommand(LaravelTabulatorMakeCommand::class);
    }
}
