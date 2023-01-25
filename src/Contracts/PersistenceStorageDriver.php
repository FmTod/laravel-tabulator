<?php

namespace FmTod\LaravelTabulator\Contracts;

use Illuminate\Database\Eloquent\Model;

interface PersistenceStorageDriver
{
    /**
     * Get all persistence data for a table.
     *
     * @param  string  $table
     * @return array
     */
    public function all(string $table): array;

    /**
     * Store all persistence data for a table.
     *
     * @param  string  $table
     * @param  array  $data
     * @return array
     */
    public function store(string $table, array $data): array;

    /**
     * Clear all persistence data for a table.
     *
     * @param  string  $table
     * @return void
     */
    public function clear(string $table): void;

    /**
     * Get a single persistence data for a table.
     *
     * @param  string  $table
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function get(string $table, string $type): ?Model;

    /**
     * Store a single persistence data for a table.
     *
     * @param  string  $table
     * @param  string  $type
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function save(string $table, string $type, array $data): Model;

    /**
     * Delete a single persistence data for a table.
     *
     * @param  string  $table
     * @param  string  $type
     * @return void
     */
    public function delete(string $table, string $type): void;
}
