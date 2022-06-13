<?php

namespace FmTod\LaravelTabulator\Concerns;

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
        $sorter = config('tabulator.sort.sorter');
        app($sorter, [$query, $sorters]);

        return $query;
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
