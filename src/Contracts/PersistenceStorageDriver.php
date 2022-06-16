<?php

namespace FmTod\LaravelTabulator\Contracts;

use Illuminate\Database\Eloquent\Model;

interface PersistenceStorageDriver
{
    public function all(string $table): array;

    public function get(string $table, string $type): ?Model;

    public function save(string $table, string $type, array $data): Model;
}
