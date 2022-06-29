<?php

namespace FmTod\LaravelTabulator\Filterers\Filters;

use FmTod\LaravelTabulator\Contracts\FiltersByType;
use Illuminate\Database\Eloquent\Builder;

class KeywordsFilter implements FiltersByType
{
    public function __invoke(Builder $query, string|array $filter): Builder
    {
        $keywords = is_string($filter['value'])
            ? explode(' ', $filter['value'])
            : $filter['value'];

        return $query->where(function (Builder $subQuery) use ($filter, $keywords) {
            foreach ($keywords as $keyword) {
                $subQuery->orWhere($filter['field'], 'like', "%$keyword%");
            }
        });
    }
}
