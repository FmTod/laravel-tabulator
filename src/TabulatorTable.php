<?php

namespace FmTod\LaravelTabulator;

use FmTod\LaravelTabulator\Concerns\HasFilters;
use FmTod\LaravelTabulator\Concerns\HasSorts;
use FmTod\LaravelTabulator\Concerns\RenderableTable;
use FmTod\LaravelTabulator\Contracts\TabulatorModel;
use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;
use RuntimeException;

abstract class TabulatorTable
{
    use Macroable;
    use RenderableTable;

    public Request $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request ?? request();
    }

    abstract protected function config(): TabulatorConfig;

    abstract protected function query(): Builder;

    abstract protected function columns(): Collection|Model|array|string;

    public function getScopedQuery(): Builder
    {
        return tap($this->query(), function (Builder $query) {
            $uses = array_flip(class_uses_recursive(static::class));

            if (isset($uses[HasFilters::class])) {
                $this->queryWithFilters($query);
            }

            if (isset($uses[HasSorts::class])) {
                $this->queryWithSorts($query);
            }
        });
    }

    public function getColumnArray(): array
    {
        if (is_string($columns = $this->columns()) || $columns instanceof Model) {
            throw_if(! class_exists($columns), RuntimeException::class, 'Class used to get the array of columns not found: '.$columns);
            throw_if(! class_implements($columns, TabulatorModel::class), RuntimeException::class, 'Class used to get the array of columns does not implement TabulatorModel: '.$columns);

            $columns = $columns::tabulatorColumns();
        }

        return Collection::wrap($columns)->toArray();
    }

    public function json(): LengthAwarePaginator|Arrayable|Jsonable|array
    {
        $query = $this->getScopedQuery();

        if ($this->options('pagination', false)) {
            $pageSize = $this->request->input('size');

            return $query->paginate($pageSize);
        }

        return $query->get();
    }
}
