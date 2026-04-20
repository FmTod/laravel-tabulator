<?php

namespace FmTod\LaravelTabulator\Filterers\Filters;

use FmTod\LaravelTabulator\Contracts\FiltersByType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use InvalidArgumentException;

class TextSearchFilter implements FiltersByType
{
    public function __invoke(Builder $query, array $filter): Builder
    {
        $type = $filter['value']['type'] ?? 'contains';

        if (! isset($filter['value']['query']) && $type !== 'empty' && $type !== 'filled') {
            // Do nothing if no query is provided and the type is not empty or filled.
            return $query;
        }

        return match ($type) {
            'except' => $this->handleException($query, $filter),
            'contains' => $this->handleContains($query, $filter),
            'starts' => $this->handleStarts($query, $filter),
            'ends' => $this->handleEnds($query, $filter),
            'exact' => $this->handleExact($query, $filter),
            'not' => $this->handleNot($query, $filter),
            'empty' => $query->where(function (Builder $query) use ($filter) {
                $query->where($filter['field'], '=', '')
                    ->orWhereNull($filter['field']);
            }),
            'filled' => $query->whereNotNull($filter['field']),
            default => throw new InvalidArgumentException("Invalid comparison type: $type"),
        };
    }

    /**
     * Squish whitespace from a value (collapse multiple spaces to single space).
     */
    private function squishValue(string $value): string
    {
        return Str::squish($value);
    }

    /**
     * Handle "except" filter type.
     */
    private function handleException(Builder $query, array $filter): Builder
    {
        $normalizedQuery = $this->squishValue($filter['value']['query']);
        $normalizedFieldExpression = DB::raw("REGEXP_REPLACE({$this->getFieldExpression($query, $filter['field'])}, '\\s+', ' ')");

        return $query->where(function (Builder $query) use ($filter, $normalizedQuery, $normalizedFieldExpression) {
            $query->where($filter['field'], 'not like', "%{$normalizedQuery}%")
                ->orWhere($normalizedFieldExpression, 'not like', "%{$normalizedQuery}%");
        });
    }

    /**
     * Handle "contains" filter type.
     */
    private function handleContains(Builder $query, array $filter): Builder
    {
        $normalizedQuery = $this->squishValue($filter['value']['query']);
        $normalizedFieldExpression = DB::raw("REGEXP_REPLACE({$this->getFieldExpression($query, $filter['field'])}, '\\s+', ' ')");

        return $query->where(function (Builder $query) use ($filter, $normalizedQuery, $normalizedFieldExpression) {
            $query->where($filter['field'], 'like', "%{$normalizedQuery}%")
                ->orWhere($normalizedFieldExpression, 'like', "%{$normalizedQuery}%");
        });
    }

    /**
     * Handle "starts" filter type.
     */
    private function handleStarts(Builder $query, array $filter): Builder
    {
        $normalizedQuery = $this->squishValue($filter['value']['query']);
        $normalizedFieldExpression = DB::raw("REGEXP_REPLACE({$this->getFieldExpression($query, $filter['field'])}, '\\s+', ' ')");

        return $query->where(function (Builder $query) use ($filter, $normalizedQuery, $normalizedFieldExpression) {
            $query->where($filter['field'], 'like', "{$normalizedQuery}%")
                ->orWhere($normalizedFieldExpression, 'like', "{$normalizedQuery}%");
        });
    }

    /**
     * Handle "ends" filter type.
     */
    private function handleEnds(Builder $query, array $filter): Builder
    {
        $normalizedQuery = $this->squishValue($filter['value']['query']);
        $normalizedFieldExpression = DB::raw("REGEXP_REPLACE({$this->getFieldExpression($query, $filter['field'])}, '\\s+', ' ')");

        return $query->where(function (Builder $query) use ($filter, $normalizedQuery, $normalizedFieldExpression) {
            $query->where($filter['field'], 'like', "%{$normalizedQuery}")
                ->orWhere($normalizedFieldExpression, 'like', "%{$normalizedQuery}");
        });
    }

    /**
     * Handle "exact" filter type.
     */
    private function handleExact(Builder $query, array $filter): Builder
    {
        $normalizedQuery = $this->squishValue($filter['value']['query']);
        $normalizedFieldExpression = DB::raw("REGEXP_REPLACE({$this->getFieldExpression($query, $filter['field'])}, '\\s+', ' ')");

        return $query->where(function (Builder $query) use ($filter, $normalizedQuery, $normalizedFieldExpression) {
            $query->where($filter['field'], '=', $normalizedQuery)
                ->orWhere($normalizedFieldExpression, '=', $normalizedQuery);
        });
    }

    /**
     * Handle "not" filter type.
     */
    private function handleNot(Builder $query, array $filter): Builder
    {
        $normalizedQuery = $this->squishValue($filter['value']['query']);
        $normalizedFieldExpression = DB::raw("REGEXP_REPLACE({$this->getFieldExpression($query, $filter['field'])}, '\\s+', ' ')");

        return $query->where(function (Builder $query) use ($filter, $normalizedQuery, $normalizedFieldExpression) {
            $query->where($filter['field'], '!=', $normalizedQuery)
                ->orWhere($normalizedFieldExpression, '!=', $normalizedQuery);
        });
    }

    /**
     * Get database-specific field expression for REGEXP_REPLACE.
     */
    private function getFieldExpression(Builder $query, string $field): string
    {
        return $query->getQuery()->getGrammar()->wrap($field);
    }
}
