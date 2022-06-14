<?php

namespace FmTod\LaravelTabulator\Filterers\Filters;

use FmTod\LaravelTabulator\Contracts\FiltersByType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class InFilter implements FiltersByType
{
    public function __invoke(Builder $query, array $filter): Builder
    {
        return $query->whereIn($filter['field'], Arr::wrap($filter['value']));
    }
}
