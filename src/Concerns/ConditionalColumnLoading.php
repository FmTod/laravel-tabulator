<?php

namespace FmTod\LaravelTabulator\Concerns;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

trait ConditionalColumnLoading
{
    protected string $queryKey = 'hidden';

    protected function conditionalColumnsAjaxParams(): string
    {
        return <<<JS
        function ajaxParams() {
             const {$this->queryKey} = this.getColumnLayout()
                .filter(column => (column.hasOwnProperty("visible") && column.visible === false) && !!column.field)
                .map(column => column.field);

            return { {$this->queryKey} }
        }
        JS;
    }

    protected function columnHidden(string $field): bool
    {
        if (! $this->request->has($this->queryKey)) {
            return false;
        }

        return $this->request->collect($this->queryKey)->contains($field);
    }

    public function queryColumnCallback(Builder $query, array|string $columns, callable $callback): Builder
    {
        $columnsHidden = array_all(Arr::wrap($columns), fn (string $column) => $this->columnHidden($column));

        return $query->unless($columnsHidden, $callback);
    }

    public function queryColumn(Builder $query, array|string $columns, array|string $selects = [], array|string $relations = [], array|string $counts = []): Builder
    {
        return $this->queryColumnCallback($query, $columns, function (Builder $query) use ($selects, $relations, $counts) {
            if (! empty($selects)) {
                $query->select($selects);
            }

            if (! empty($relations)) {
                $query->with(Arr::wrap($relations));
            }

            if (! empty($counts)) {
                $query->withCount(Arr::wrap($counts));
            }
        });
    }

    public function queryColumnRaw(Builder $query, array|string $columns, string $expression, array $bindings = []): Builder
    {
        return $this->queryColumnCallback($query, $columns, function (Builder $query) use ($bindings, $expression) {
            $query->selectRaw($expression, $bindings);
        });
    }
}
