<?php

namespace FmTod\LaravelTabulator\Sorters;

use FmTod\LaravelTabulator\Contracts\SortsTable;
use FmTod\LaravelTabulator\Exceptions\InvalidSortFieldException;
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

    public function applyRelationSort(Builder $query, string $field, string $direction): Builder
    {
        $sortableRelations = config('tabulator.sort.relations');
        [$relation, $field] = explode('.', $field);
        $instance = $this->getRelationInstance($query, $relation);

        foreach ($sortableRelations as $type => $sortBy) {
            if (is_a($instance, $type)) {
                return $sortBy($query, $instance, $field, $direction);
            }
        }

        return $query;
    }

    public function getRelationInstance(Builder $query, string $relation): Relation
    {
        $parentModel = $query->newModelInstance();

        if (method_exists($parentModel, $relation)) {
            return $parentModel->{$relation}();
        }

        if (method_exists($parentModel, Str::camel($relation))) {
            return $parentModel->{Str::camel($relation)}();
        }

        throw new InvalidSortFieldException("Could not find a relation with the name '$relation'.");
    }
}
