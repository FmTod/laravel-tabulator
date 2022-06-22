<?php

namespace FmTod\LaravelTabulator;

use FmTod\LaravelTabulator\Contracts\PersistenceStorageDriver;
use FmTod\LaravelTabulator\Controllers\PersistenceController;
use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
use FmTod\LaravelTabulator\Persistence\DatabaseStorage;
use Illuminate\Database\Eloquent\Model;
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

    public function persistenceRoutes(string $name = 'tabulator.persistence', string $prefix = null): void
    {
        Route::as("$name.")->prefix($prefix ?? str_replace('.', '/', $name))->group(function () {
            Route::get('/{table}', [PersistenceController::class, 'index'])->name('index');
            Route::delete('/{table}', [PersistenceController::class, 'clear'])->name('clear');
            Route::get('/{table}/{type}', [PersistenceController::class, 'show'])->name('show');
            Route::post('/{table}/{type}', [PersistenceController::class, 'store'])->name('store');
            Route::delete('/{table}/{type}', [PersistenceController::class, 'destroy'])->name('destroy');
        });
    }

    public function persistenceTable(string $table): array
    {
        return $this->persistenceDriver->all($table);
    }

    public function persistenceGet(string $table, string $type): ?Model
    {
        return $this->persistenceDriver->get($table, $type);
    }

    public function persistenceSave(string $table, string $type, array $data): Model
    {
        return $this->persistenceDriver->save($table, $type, $data);
    }

    public function persistenceDelete(string $table, string $type): void
    {
        $this->persistenceDriver->delete($table, $type);
    }

    public function persistenceClear(string $table): void
    {
        $this->persistenceDriver->clear($table);
    }
}
