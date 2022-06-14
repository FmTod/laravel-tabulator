<?php

namespace FmTod\LaravelTabulator\Filterers\Filters;

use FmTod\LaravelTabulator\Contracts\FiltersByType;
use Illuminate\Database\Eloquent\Builder;

class KeywordsFilter implements FiltersByType
{
    public function __invoke(Builder $query, array $filter): Builder
    {
        $keywords = explode(' ', $filter['value']);

        return $query->where(function (Builder $subQuery) use ($filter, $keywords) {
            foreach ($keywords as $keyword) {
                $subQuery->orWhere($filter['field'], 'like', "%$keyword%");
            }
        });
    }
}