<?php

namespace FmTod\LaravelTabulator\Sorters;

use FmTod\LaravelTabulator\Contracts\SortsByRelation;
use FmTod\LaravelTabulator\Contracts\SortsTable;
use FmTod\LaravelTabulator\Exceptions\InvalidSorterException;
use FmTod\LaravelTabulator\Exceptions\InvalidFieldException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class DefaultSorter implements SortsTable
{
    public function __invoke(Builder $query, ?array $sorts): Builder
    {
        $sorts = Arr::wrap($sorts);

        foreach ($sorts as $sort) {
            if (Str::contains($sort['field'], '.')) {
                $this->applyRelationSort($query, $sort['field'], $sort['dir']);
            } else {
                $query->orderBy($sort['field'], $sort['dir']);
            }
        }

        return $query;
    }

    protected function applyRelationSort(Builder $query, string $field, string $direction): Builder
    {
        $sortableRelations = config('tabulator.sort.relations');
        [$relation, $field] = explode('.', $field);
        $instance = $this->getRelationInstance($query, $relation);

        foreach ($sortableRelations as $type => $sorter) {
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
