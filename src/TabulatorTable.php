<?php

namespace FmTod\LaravelTabulator;

use FmTod\LaravelTabulator\Concerns\HasFilters;
use FmTod\LaravelTabulator\Concerns\HasSorts;
use FmTod\LaravelTabulator\Concerns\RenderableTable;
use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Traits\Macroable;

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

    abstract protected function columns(): array;

    public function json(): LengthAwarePaginator
    {
        $pageSize = $this->request->input('size');

        return tap($this->query(), function (Builder $query) {
            $uses = array_flip(class_uses_recursive(static::class));

            if (isset($uses[HasFilters::class])) {
                $this->queryWithFilters($query);
            }

            if (isset($uses[HasSorts::class])) {
                $this->queryWithSorts($query);
            }
        })->paginate($pageSize);
    }
}
