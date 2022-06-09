<?php

namespace FmTod\LaravelTabulator;

use FmTod\LaravelTabulator\Commands\TabulatorMakeCommand;
use FmTod\LaravelTabulator\Contracts\RendersTable;
use FmTod\LaravelTabulator\Renderer\BladeRenderer;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TabulatorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-tabulator')
            ->hasConfigFile()
            ->hasViews()
            ->hasCommand(TabulatorMakeCommand::class);
    }

    public function packageRegistered(): void
    {
        $this->app->bind('tabulator', Tabulator::class);
        $this->app->bind(RendersTable::class, BladeRenderer::class);
    }
}
