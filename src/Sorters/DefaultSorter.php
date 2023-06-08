<?php

namespace FmTod\LaravelTabulator\Sorters;

use Closure;
use FmTod\LaravelTabulator\Contracts\SortsByRelation;
use FmTod\LaravelTabulator\Contracts\SortsTable;
use FmTod\LaravelTabulator\Exceptions\InvalidFieldException;
use FmTod\LaravelTabulator\Exceptions\InvalidSorterException;
use FmTod\LaravelTabulator\TabulatorTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DefaultSorter implements SortsTable
{
    public function __invoke(TabulatorTable $table, Builder $query, ?array $sorts): Builder
    {
        $sorts = Arr::wrap($sorts);

        foreach ($sorts as $sort) {
            $column = $table->getFieldColumn($sort['field']);
            $field = $column['sortField'] ?? $sort['field'];

            if (isset($column['sortFunc']) && (is_callable($column['sortFunc']) || $column['sortFunc'] instanceof Closure)) {
                $column['sortFunc']($query, $field, $sort['dir']);

                continue;
            }

            $includeTableName = $column['sortIncludeTableName']
                ?? $column['includeTableName']
                ?? $table->options('sortsIncludeTableName')
                ?? $table->options('includeTableName')
                ?? config('tabulator.sort.include_table_name')
                ?? false;

            if (Str::contains($field, '.')) {
                $sorters = (array) config('tabulator.sort.relations', []);
                $relationName = Str::before($field, '.');
                $relationField = Str::after($field, '.');

                $this->applyRelationSort($relationName, $query, $relationField, $sort['dir'], $sorters, $includeTableName);

                continue;
            }

            if ($table->options('dataTree', false) &&
                $table->options('dataTreeSort', true) &&
                ! Schema::connection($query->getModel()->getConnectionName())
                    ->hasColumn($query->getModel()->getTable(), $field)) {
                $sorters = array_merge((array) config('tabulator.sort.tree', []), (array) config('tabulator.sort.tree', []));
                $relationName = $table->options('dataTreeChildField', '_children');

                $this->applyTreeChildSort($relationName, $query, $field, $sort['dir'], $sorters, $includeTableName);

                continue;
            }

            $this->applySort($query, $field, $sort['dir'], $includeTableName);
        }

        return $query;
    }

    protected function applySort(Builder $query, string $field, string $direction, bool $includeTable = false): void
    {
        $tableName = $query->getModel()?->getTable();
        $field = $includeTable && $tableName ? "$tableName.$field" : $field;

        $query->orderBy($field, $direction);
    }

    protected function applyTreeChildSort(string $relation, Builder $query, string $field, string $direction, array $sorters, bool $includeTable = false): Builder
    {
        return $this
            ->applyRelationSort($relation, $query, $field, $direction, $sorters, $includeTable)
            ->with($relation, fn (Relation $relQuery) => $relQuery->orderBy($field, $direction));
    }

    protected function applyRelationSort(string $relation, Builder $query, string $field, string $direction, array $sorters, bool $includeTable = false): Builder
    {
        $instance = $this->getRelationInstance($query, $relation);

        $tableName = $instance->getModel()?->getTable();
        $field = $includeTable && $tableName ? "$tableName.$field" : $field;

        foreach ($sorters as $type => $sorter) {
            if (is_a($instance, $type)) {
                /** @var \FmTod\LaravelTabulator\Contracts\SortsByRelation $sortBy */
                $sortBy = app($sorter);

                if (! $sortBy instanceof SortsByRelation) {
                    throw new InvalidSorterException("The relation sorter '$sorter' must implement the SortsByRelation interface.");
                }

                return $sortBy($query, $instance, $field, $direction);
            }
        }

        return $query;
    }

    protected function getRelationInstance(Builder $query, string $relation): Relation
    {
        $parentModel = $query->newModelInstance();

        if (method_exists($parentModel, $relation)) {
            return $parentModel->{$relation}();
        }

        if (method_exists($parentModel, Str::camel($relation))) {
            return $parentModel->{Str::camel($relation)}();
        }

        throw new InvalidFieldException("Could not find a relation with the name '$relation'.");
    }
}
