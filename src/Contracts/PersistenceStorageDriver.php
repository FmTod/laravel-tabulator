<?php

namespace FmTod\LaravelTabulator\Contracts;

use Illuminate\Database\Eloquent\Model;

interface PersistenceStorageDriver
{
    /**
     * Get all persistence data for a table.
     */
    public function all(string $table): array;

    /**
     * Store all persistence data for a table.
     */
    public function store(string $table, array $data): array;

    /**
     * Clear all persistence data for a table.
     */
    public function clear(string $table): void;

    /**
     * Get a single persistence data for a table.
     */
    public function get(string $table, string $type): ?Model;

    /**
     * Store a single persistence data for a table.
     */
    public function save(string $table, string $type, array $data): Model;

    /**
     * Delete a single persistence data for a table.
     */
    public function delete(string $table, string $type): void;
}
