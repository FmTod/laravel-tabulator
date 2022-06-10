<?php

namespace FmTod\LaravelTabulator\Concerns;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait HasFilters
{
    public function getFilters(): ?array
    {
        $filtersParam = $this->config()->dataSendParams['filters'] ?? 'filters';

        return $this->request->input($filtersParam);
    }

    public function hasFilters(): bool
    {
        return ! empty($this->getFilters());
    }

    public function applyFilters(Builder $query, array $filters): Builder
    {
        foreach ($filters as $filter) {
            match ($filter['type']) {
                '=', '!=', '<', '<=', '>', '>=' => $query->where($filter['field'], $filter['type'], $filter['value']),
                'like' => $query->where($filter['field'], 'like', "%{$filter['value']}%"),
                'starts' => $query->where($filter['field'], 'like', "{$filter['value']}%"),
                'ends' => $query->where($filter['field'], 'like', "%{$filter['value']}"),
                'in' => $query->where($filter['field'], 'in', '('.implode(',', $filter['value']).')'),
                'keywords' => $query->where(function (Builder $subQuery) use ($filter) {
                    $keywords = explode(' ', $filter['value']);

                    foreach ($keywords as $keyword) {
                        $subQuery->orWhere($filter['field'], 'like', "%$keyword%");
                    }
                }),
                'minMax' => $query->where(
                    function (Builder $subQuery) use ($filter) {
                    if (isset($filter['value']['min'])) {
                        $subQuery->where($filter['field'], '>=', $filter['value']['min']);
                    }

                    if (isset($filter['value']['max'])) {
                        $subQuery->where($filter['field'], '<=', $filter['value']['max']);
                    }
                }
                )
            };
        }

        return $query;
    }

    public function queryWithFilters(): Builder
    {
        $query = $this->query();

        if ($this->hasFilters()) {
            $filters = $this->getFilters();

            $this->applyFilters($query, $filters);
        }

        return $query;
    }
}
