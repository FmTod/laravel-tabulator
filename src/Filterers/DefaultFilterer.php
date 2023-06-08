<?php

namespace FmTod\LaravelTabulator\Filterers;

use Closure;
use FmTod\LaravelTabulator\Contracts\FiltersByType;
use FmTod\LaravelTabulator\Contracts\FiltersTable;
use FmTod\LaravelTabulator\Exceptions\InvalidFieldException;
use FmTod\LaravelTabulator\Exceptions\InvalidFilterException;
use FmTod\LaravelTabulator\TabulatorTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DefaultFilterer implements FiltersTable
{
    public function __invoke(TabulatorTable $table, Builder $query, ?array $filters): Builder
    {
        $filters = Arr::wrap($filters);

        foreach ($filters as $filter) {
            $column = $table->getFieldColumn($filter['field']);
            $field = $column['filterField'] ?? $filter['field'];

            $includeTableName = $column['filterIncludeTableName']
                ?? $column['includeTableName']
                ?? $table->options('filtersIncludeTableName')
                ?? $table->options('includeTableName')
                ?? config('tabulator.filter.include_table_name')
                ?? false;

            if (empty($filter['value'])) {
                continue;
            }

            if (isset($column['filterFunc']) && (is_callable($column['filterFunc']) || $column['filterFunc'] instanceof Closure)) {
                $column['filterFunc']($query, $field, $filter['type'], $filter['value']);

                continue;
            }

            if (Str::contains($filter['field'], '.')) {
                $this->applyRelationFilter($query, $field, $filter['type'], $filter['value'], $includeTableName);

                continue;
            }

            if ($table->options('dataTree', false) &&
                $table->options('dataTreeFilter', true) &&
                ! Schema::connection($query->getModel()->getConnectionName())
                    ->hasColumn($query->getModel()->getTable(), $field)) {
                $childrenRelation = $table->options('dataTreeChildField', '_children');
                $this->applyTreeChildFilter($childrenRelation, $query, $field, $filter['type'], $filter['value'], $includeTableName);

                continue;
            }

            $this->applyFilter($query, $field, $filter['type'], $filter['value'], $includeTableName);
        }

        return $query;
    }

    protected function applyFilter(Builder $query, string $field, string $type, mixed $value, bool $includeTable = false): Builder
    {
        $availableFilters = config('tabulator.filter.types');

        $tableName = $query->getModel()?->getTable();
        $field = $includeTable && $tableName ? "$tableName.$field" : $field;

        foreach ($availableFilters as $filtererClass => $types) {
            if (in_array($type, Arr::wrap($types)) && ! empty($value)) {
                /** @var \FmTod\LaravelTabulator\Contracts\FiltersByType $filterer */
                $filterer = app($filtererClass);

                if (! $filterer instanceof FiltersByType) {
                    throw new InvalidFilterException("The filter '$filtererClass' must implement the FiltersByType interface.");
                }

                return $filterer($query, [
                    'field' => $field,
                    'type' => $type,
                    'value' => $value,
                ]);
            }
        }

        return $query;
    }

    protected function applyRelationFilter(Builder $query, string $field, string $type, mixed $value, bool $includeTable = false): Builder
    {
        $relation = $this->getRelation($query, $field);

        return $query->where(
            fn (Builder $subQuery) => $subQuery
                ->whereHas(
                    relation: $relation,
                    callback: fn (Builder $query) => $this->applyFilter(
                        query: $query,
                        field: Str::after($field, '.'),
                        type: $type,
                        value: $value,
                        includeTable: $includeTable
                    )
                )
                ->when(
                    value: $type === 'textSearch' && isset($value['type']) && in_array($value['type'], ['not', 'empty', 'expect']),
                    callback: fn (Builder $query) => $query->orDoesntHave($relation),
                )
        );
    }

    protected function applyTreeChildFilter(string $relation, Builder $query, string $field, string $type, mixed $value, bool $includeTable = false): Builder
    {
        return $query->withWhereHas(
            relation: $relation,
            callback: fn (Builder $query) => $this->applyFilter(
                query: $query,
                field: $field,
                type: $type,
                value: $value,
                includeTable: $includeTable
            ),
        );
    }

    protected function getRelation(Builder $query, string $field): string
    {
        $relation = Str::before($field, '.');

        $parentModel = $query->newModelInstance();

        if (method_exists($parentModel, $relation)) {
            return $relation;
        }

        if (method_exists($parentModel, Str::camel($relation))) {
            return Str::camel($relation);
        }

        throw new InvalidFieldException("Could not find a relation with the name '$relation'.");
    }
}
