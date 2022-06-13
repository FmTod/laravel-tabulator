<?php

namespace FmTod\LaravelTabulator\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

interface SortsByRelation
{
    /**
     * Sorts query by relation.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $parent
     * @param  \Illuminate\Database\Eloquent\Relations\Relation  $relation
     * @param  string  $field
     * @param  string  $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function __invoke(Builder $parent, Relation $relation, string $field, string $direction): Builder;
}