<?php

namespace FmTod\LaravelTabulator\Tests;

use FmTod\LaravelTabulator\TabulatorServiceProvider;
use FmTod\LaravelTabulator\Tests\stubs\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            TabulatorServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
    }
}
