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

    /**
     * Rows the current user owns. Everything that writes goes through here, so a
     * shared row is never overwritten or deleted on one user's behalf.
     */
    protected function query(): Builder
    {
        return $this->model::when($this->perUser, fn (Builder $query) => $query->where('user_id', auth()->id()));
    }

    /**
     * Rows the current user can read: their own, plus the rows belonging to no user —
     * the tenant-wide fallback. Ordered so the user's own row comes first and wins.
     */
    protected function readQuery(): Builder
    {
        return $this->model::when($this->perUser, fn (Builder $query) => $query
            ->where(fn (Builder $owned) => $owned->where('user_id', auth()->id())->orWhereNull('user_id'))
            ->orderByRaw('user_id is null'));
    }

    public function all(string $table): array
    {
        return $this->readQuery()
            ->where('table', $table)
            ->get(['type', 'data'])
            ->reduce(
                // Union keeps the first row for a type, and own rows are ordered first, so a
                // fallback only fills in a type the user has not overridden.
                fn (array $carry, $persistence) => $carry + [$persistence->type => $persistence->data],
                []
            );
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
        return $this->readQuery()
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
