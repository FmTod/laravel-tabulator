<?php

namespace FmTod\LaravelTabulator\Filterers\Filters;

use FmTod\LaravelTabulator\Contracts\FiltersByType;
use Illuminate\Database\Eloquent\Builder;

class EndsFilter implements FiltersByType
{

    public function __invoke(Builder $query, array $filter): Builder
    {
        return $query->where($filter['field'], 'like', "%{$filter['value']}");
    }
}