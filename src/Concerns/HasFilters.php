<?php

namespace FmTod\LaravelTabulator\Concerns;

use FmTod\LaravelTabulator\Contracts\FiltersTable;
use FmTod\LaravelTabulator\Exceptions\InvalidFilterException;
use FmTod\LaravelTabulator\Filterers\DefaultFilterer;
use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    public function getFilters(): ?array
    {
        $filtersParam = $this->config()->dataSendParams['filters'] ?? 'filter';

        return $this->request->input($filtersParam);
    }

    public function hasFilters(): bool
    {
        return ! empty($this->getFilters());
    }

    public function applyFilters(Builder $query, array $filters): Builder
    {
        $filter = app(config('tabulator.filter.filterer', DefaultFilterer::class));

        if (! $filter instanceof FiltersTable) {
            throw new InvalidFilterException('Sorter must implement SortsTable');
        }

        return $filter($query, $filters);
    }

    public function queryWithFilters(Builder $query): Builder
    {
        if ($this->hasFilters()) {
            $filters = $this->getFilters();

            $this->applyFilters($query, $filters);
        }

        return $query;
    }
}
