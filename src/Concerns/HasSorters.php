<?php

namespace FmTod\LaravelTabulator\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait HasSorters
{
    public function getSorters(): ?array
    {
        $sortersParam = $this->config()->dataSendParams['sorters'] ?? 'sort';

        return $this->request->input($sortersParam);
    }

    public function hasSorters(): bool
    {
        return ! empty($this->getSorters());
    }

    public function applySorters(Builder $query, array $sorters): Builder
    {
        foreach ($sorters as $sorter) {
            $query->orderBy($sorter['field'], $sorter['dir']);
        }

        return $query;
    }

    public function queryWithSorters(Builder $query): Builder
    {
        if ($this->hasSorters()) {
            $filters = $this->getSorters();

            $this->applySorters($query, $filters);
        }

        return $query;
    }
}
