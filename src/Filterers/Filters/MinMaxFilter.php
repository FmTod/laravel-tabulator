<?php

namespace FmTod\LaravelTabulator\Filterers\Filters;

use FmTod\LaravelTabulator\Contracts\FiltersByType;
use Illuminate\Database\Eloquent\Builder;

class MinMaxFilter implements FiltersByType
{
    public function __invoke(Builder $query, array $filter): Builder
    {
        if (isset($filter['value']['min'])) {
            $query->where($filter['field'], '>=', $filter['value']['min']);
        }

        if (isset($filter['value']['max'])) {
            $query->where($filter['field'], '<=', $filter['value']['max']);
        }

        return $query;
    }
}
