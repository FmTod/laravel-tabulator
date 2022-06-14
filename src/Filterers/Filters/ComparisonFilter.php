<?php

namespace FmTod\LaravelTabulator\Filterers\Filters;

use FmTod\LaravelTabulator\Contracts\FiltersByType;
use Illuminate\Database\Eloquent\Builder;
use InvalidArgumentException;

class ComparisonFilter implements FiltersByType
{
    public function __invoke(Builder $query, array $filter): Builder
    {
        if (! in_array($filter['type'], ['=', '!=', '<', '<=', '>', '>='])) {
            throw new InvalidArgumentException("Invalid comparison type: {$filter['type']}");
        }

        return $query->where($filter['field'], $filter['type'], $filter['value']);
    }
}