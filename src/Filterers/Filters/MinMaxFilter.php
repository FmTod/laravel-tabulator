<?php

namespace FmTod\LaravelTabulator\Filterers\Filters;

use FmTod\LaravelTabulator\Contracts\FiltersByType;
use Illuminate\Database\Eloquent\Builder;

/**
 * Filters a column to a `min`/`max` range. The optional `nulls` key decides how rows without a
 * value are treated: `include` adds them to the range, `exclude` drops them, `only` keeps just them.
 */
class MinMaxFilter implements FiltersByType
{
    public function __invoke(Builder $query, array $filter): Builder
    {
        $field = $filter['field'];
        $value = $filter['value'];
        $hasRange = filled($value['min'] ?? null) || filled($value['max'] ?? null);

        return match ($value['nulls'] ?? null) {
            'only' => $query->whereNull($field),
            'exclude' => $this->applyRange($query->whereNotNull($field), $field, $value),
            'include' => $hasRange
                ? $query->where(fn (Builder $range) => $this->applyRange($range, $field, $value)->orWhereNull($field))
                : $query,
            default => $this->applyRange($query, $field, $value),
        };
    }

    protected function applyRange(Builder $query, string $field, array $value): Builder
    {
        if (filled($value['min'] ?? null)) {
            $query->where($field, '>=', $value['min']);
        }

        if (filled($value['max'] ?? null)) {
            $query->where($field, '<=', $value['max']);
        }

        return $query;
    }
}
