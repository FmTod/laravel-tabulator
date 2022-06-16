<?php

namespace FmTod\LaravelTabulator\Models;

use Illuminate\Database\Eloquent\Model;

class TabulatorPersistence extends Model
{
    protected $casts = [
        'data' => 'array',
    ];

    public function getConnectionName(): ?string
    {
        if ($connection = config('tabulator.persistence.database.connection')) {
            return $connection;
        }

        return parent::getConnectionName();
    }

    public function getTable(): string
    {
        return config('tabulator.persistence.database.table');
    }

    public function getFillable(): array
    {
        if (config('tabulator.persistence.database.per_user', false)) {
            return array_merge([
                'user_id',
                'table',
                'type',
                'data',
            ]);
        }

        return array_merge([
            'table',
            'type',
            'data',
        ]);
    }
}
