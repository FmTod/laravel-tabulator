<?php

namespace FmTod\LaravelTabulator;

use FmTod\LaravelTabulator\Contracts\PersistenceStorageDriver;
use FmTod\LaravelTabulator\Controllers\PersistenceController;
use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
use FmTod\LaravelTabulator\Persistence\DatabaseStorage;
use Illuminate\Support\Facades\Route;

class Tabulator
{
    protected PersistenceStorageDriver $persistenceDriver;

    public function __construct()
    {
        $this->persistenceDriver = app(config('tabulator.persistence.driver', DatabaseStorage::class));
    }

    public function config(array $options = []): TabulatorConfig
    {
        return TabulatorConfig::make($options);
    }

    public function persistenceRoutes(string $name = 'tabulator.persistence', string $prefix = 'tabulator/persistence'): void
    {
        Route::as("$name.")->prefix($prefix)->group(function () {
            Route::get('/{table}', [PersistenceController::class, 'index'])->name('index');
            Route::get('/{table}/{type}', [PersistenceController::class, 'show'])->name('show');
            Route::post('/{table}/{type}', [PersistenceController::class, 'store'])->name('store');
        });
    }

    public function persistenceTable(string $table): array
    {
        return $this->persistenceDriver->all($table);
    }

    public function persistenceGet(string $table, string $type): bool
    {
        return $this->persistenceDriver->get($table, $type);
    }

    public function persistenceSave(string $table, string $type, array $data): bool
    {
        return $this->persistenceDriver->save($table, $type, $data);
    }
}
