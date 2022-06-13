<?php

namespace FmTod\LaravelTabulator\Sorters\Relations;

use FmTod\LaravelTabulator\Contracts\SortsByRelation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;

class SortByHasMany implements SortsByRelation
{
    /**
     * Sorts query by HasMany relation.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $parent
     * @param  \Illuminate\Database\Eloquent\Relations\HasMany  $relation
     * @param  string  $field
     * @param  string  $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function __invoke(Builder $parent, Relation $relation, string $field, string $direction): Builder
    {
        $query = $relation
            ->getModel()
            ->select($field)
            ->whereColumn(
                $relation->getQualifiedParentKeyName(),
                $relation->getQualifiedForeignKeyName()
            )
            ->latest($field)
            ->limit(1);

        return $parent->orderBy($query, $direction);
    }
}
