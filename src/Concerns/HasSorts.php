<?php

namespace FmTod\LaravelTabulator\Concerns;

use FmTod\LaravelTabulator\Contracts\SortsTable;
use FmTod\LaravelTabulator\Exceptions\InvalidSorterException;
use FmTod\LaravelTabulator\Sorters\DefaultSorter;
use Illuminate\Database\Eloquent\Builder;

trait HasSorts
{
    public function getSorts(): ?array
    {
        $sortersParam = $this->config()->dataSendParams['sorters'] ?? 'sort';

        return $this->request->input($sortersParam);
    }

    public function hasSorts(): bool
    {
        return ! empty($this->getSorts());
    }

    public function applySorts(Builder $query, array $sorters): Builder
    {
        $sorter = app(config('tabulator.sort.sorter', DefaultSorter::class));

        if (! $sorter instanceof SortsTable) {
            throw new InvalidSorterException('Sorter must implement SortsTable');
        }

        return $sorter($query, $sorters);
    }

    public function queryWithSorts(Builder $query): Builder
    {
        if ($this->hasSorts()) {
            $filters = $this->getSorts();

            $this->applySorts($query, $filters);
        }

        return $query;
    }
}
