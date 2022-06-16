<?php

namespace FmTod\LaravelTabulator;

use FmTod\LaravelTabulator\Contracts\PersistenceStorageDriver;
use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
use FmTod\LaravelTabulator\Persistence\DatabaseStorage;

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
