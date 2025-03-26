<?php

namespace FmTod\LaravelTabulator\Sorters\Relations;

use FmTod\LaravelTabulator\Contracts\SortsByRelation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class SortByBelongsTo implements SortsByRelation
{
    /**
     * Sorts query by BelongsTo relation.
     *
     * @param  \Illuminate\Database\Eloquent\Relations\BelongsTo  $relation
     */
    public function __invoke(Builder $parent, Relation $relation, string $field, string $direction): Builder
    {
        $query = $relation
            ->getModel()
            ->select($field)
            ->whereColumn(
                $relation->getQualifiedOwnerKeyName(),
                $relation->getQualifiedForeignKeyName()
            );

        return $parent->orderBy($query, $direction);
    }
}
