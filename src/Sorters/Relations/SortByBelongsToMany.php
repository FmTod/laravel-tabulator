<?php

namespace FmTod\LaravelTabulator\Sorters\Relations;

use FmTod\LaravelTabulator\Contracts\SortsByRelation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class SortByBelongsToMany implements SortsByRelation
{
    /**
     * Sorts query by BelongsToMany relation.
     *
     * @param  \Illuminate\Database\Eloquent\Relations\BelongsToMany  $relation
     */
    public function __invoke(Builder $parent, Relation $relation, string $field, string $direction): Builder
    {
        $query = $relation
            ->getModel()
            ->select($field)
            ->join(
                table: $relation->getTable(),
                first: $relation->getQualifiedRelatedKeyName(),
                operator: '=',
                second: $relation->getQualifiedRelatedPivotKeyName()
            )
            ->whereColumn(
                $relation->getQualifiedRelatedPivotKeyName(),
                $relation->getQualifiedParentKeyName()
            )
            ->latest($field)
            ->limit(1);

        return $parent->orderBy($query, $direction);
    }
}
