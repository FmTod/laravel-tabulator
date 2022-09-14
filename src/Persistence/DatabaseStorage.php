<?php

namespace FmTod\LaravelTabulator\Persistence;

use FmTod\LaravelTabulator\Contracts\PersistenceStorageDriver;
use FmTod\LaravelTabulator\Models\TabulatorPersistence;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DatabaseStorage implements PersistenceStorageDriver
{
    /** @var class-string */
    protected string $model;

    protected bool $perUser;

    public function __construct()
    {
        $this->perUser = config('tabulator.persistence.database.per_user', false);
        $this->model = config('tabulator.persistence.database.model', TabulatorPersistence::class);
    }

    protected function query(): Builder
    {
        return $this->model::when($this->perUser, fn (Builder $query) => $query->where('user_id', auth()->id()));
    }

    public function all(string $table): array
    {
        return $this->query()
            ->where('table', $table)
            ->get(['type', 'data'])
            ->reduce(function (array $carry, $persistence) {
                $carry[$persistence->type] = $persistence->data;

                return $carry;
            }, []);
    }

    public function store(string $table, array $data): array
    {
        foreach ($data as $type => $value) {
            $this->save($table, $type, $value);
        }

        return $this->all($table);
    }

    public function get(string $table, string $type): ?Model
    {
        return $this->query()
            ->where('table', $table)
            ->where('type', $type)
            ->first();
    }

    public function save(string $table, string $type, array $data): Model
    {
        $persistence = $this->query()->firstOrNew([
            'table' => $table,
            'type' => $type,
        ]);

        if ($this->perUser) {
            $persistence->user_id = auth()->id();
        }

        $persistence->data = $data;
        $persistence->save();

        return $persistence;
    }

    public function delete(string $table, string $type): void
    {
        $keyName = $this->query()->newModelInstance()->getKeyName();

        $this->query()
            ->where('table', $table)
            ->where('type', $type)
            ->get([$keyName])
            ->each
            ->delete();
    }

    public function clear(string $table): void
    {
        $keyName = $this->query()->newModelInstance()->getKeyName();

        $this->query()
            ->where('table', $table)
            ->get([$keyName])
            ->each
            ->delete();
    }
}
