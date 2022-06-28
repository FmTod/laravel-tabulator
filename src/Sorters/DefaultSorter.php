<?php

namespace FmTod\LaravelTabulator\Sorters;

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
            if (Str::contains($sort['field'], '.')) {
                $sorters = config('tabulator.sort.relations', []);
                $relation = Str::before($sort['field'], '.');
                $field = Str::after($sort['field'], '.');

                $this->applyRelationSort($relation, $query, $field, $sort['dir'], $sorters);

                continue;
            }

            if ($table->options('dataTree', false) &&
                $table->options('dataTreeSort', true) &&
                ! Schema::connection($query->getModel()->getConnectionName())
                    ->hasColumn($query->getModel()->getTable(), $sort['field'])) {

                $sorters = array_merge(config('tabulator.sort.tree', []), config('tabulator.sort.tree', []));
                $relation = $table->options('dataTreeChildField', '_children');

                $this->applyRelationSort($relation, $query, $sort['field'], $sort['dir'], $sorters);

                continue;
            }

            $query->orderBy($sort['field'], $sort['dir']);
        }

        return $query;
    }

    protected function applyRelationSort(string $relation, Builder $query, string $field, string $direction, array $sorters): Builder
    {
        $instance = $this->getRelationInstance($query, $relation);

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
