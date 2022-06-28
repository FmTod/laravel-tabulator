<?php

namespace FmTod\LaravelTabulator\Concerns;

use FmTod\LaravelTabulator\Contracts\SortsTable;
use FmTod\LaravelTabulator\Exceptions\InvalidSorterException;
use FmTod\LaravelTabulator\Sorters\DefaultSorter;
use FmTod\LaravelTabulator\TabulatorTable;
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

    public function applySorts(TabulatorTable $table, Builder $query, array $sorters): Builder
    {
        $sorter = app(config('tabulator.sort.sorter', DefaultSorter::class));

        if (! $sorter instanceof SortsTable) {
            throw new InvalidSorterException('Sorter must implement SortsTable');
        }

        return $sorter($table, $query, $sorters);
    }

    public function queryWithSorts(TabulatorTable $table, Builder $query): Builder
    {
        if ($this->hasSorts()) {
            $sorts = $this->getSorts();

            $this->applySorts($table, $query, $sorts);
        }

        return $query;
    }
}
