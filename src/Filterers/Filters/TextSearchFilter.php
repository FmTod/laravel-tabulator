<?php

namespace FmTod\LaravelTabulator\Filterers\Filters;

use FmTod\LaravelTabulator\Contracts\FiltersByType;
use Illuminate\Database\Eloquent\Builder;
use InvalidArgumentException;

class TextSearchFilter implements FiltersByType
{
    public function __invoke(Builder $query, array $filter): Builder
    {
        $type = $filter['value']['type'] ?? 'contains';

        if (! isset($filter['value']['query']) && $type !== 'empty') {
            throw new InvalidArgumentException('The filter value must contain a "query" key.');
        }

        return match ($type) {
            'except' => $query->where($filter['field'], 'not like', "%{$filter['value']['query']}%"),
            'contains' => $query->where($filter['field'], 'like', "%{$filter['value']['query']}%"),
            'starts' => $query->where($filter['field'], 'like', "{$filter['value']['query']}%"),
            'ends' => $query->where($filter['field'], 'like', "%{$filter['value']['query']}"),
            'exact' => $query->where($filter['field'], '=', $filter['value']['query']),
            'not' => $query->where($filter['field'], '!=', $filter['value']['query']),
            'empty' => $query->where(function (Builder $query) use ($filter) {
                $query->where($filter['field'], '=', '')
                    ->orWhereNull($filter['field']);
            }),
            default => throw new InvalidArgumentException("Invalid comparison type: $type"),
        };
    }
}
