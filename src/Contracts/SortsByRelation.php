<?php

namespace FmTod\LaravelTabulator\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

interface SortsByRelation
{
    /**
     * Sorts query by relation.
     */
    public function __invoke(Builder $parent, Relation $relation, string $field, string $direction): Builder;
}
