<?php

namespace FmTod\LaravelTabulator;

use FmTod\LaravelTabulator\Commands\TabulatorMakeCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TabulatorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-tabulator')
            ->hasConfigFile()
            ->hasMigration('create_tabulator_persistence_table')
            ->hasCommand(TabulatorMakeCommand::class);
    }

    public function packageRegistered(): void
    {
        $this->app->bind('tabulator', Tabulator::class);
    }

    public function packageBooted()
    {
        $this->publishes([
            $this->package->basePath('/../stubs/tabulator.table.stub') => base_path("stubs/tabulator.table.stub"),
        ], "{$this->package->name}-stubs");
    }
}
