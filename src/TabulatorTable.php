<?php

namespace FmTod\LaravelTabulator;

use FmTod\LaravelTabulator\Concerns\HasFilters;
use FmTod\LaravelTabulator\Concerns\HasParameters;
use FmTod\LaravelTabulator\Concerns\HasRequest;
use FmTod\LaravelTabulator\Concerns\HasSorts;
use FmTod\LaravelTabulator\Concerns\InitializeTraits;
use FmTod\LaravelTabulator\Concerns\RenderableTable;
use FmTod\LaravelTabulator\Contracts\TabulatorModel;
use FmTod\LaravelTabulator\Helpers\Column;
use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;

abstract class TabulatorTable
{
    use HasParameters;
    use HasRequest;
    use InitializeTraits;
    use Macroable;
    use RenderableTable;

    public ?string $optionsKey;

    public function __construct(?Request $request = null, Collection|array|null $parameters = null)
    {
        $this->initializeTraits();

        if ($request) {
            $this->setRequest($request);
        }

        if ($parameters) {
            $this->setAllParameters($parameters);
        }
    }

    abstract public function config(): TabulatorConfig;

    abstract public function query(): Builder|Model;

    abstract public function columns(): Collection|Model|array|string;

    public function actions(): array
    {
        return [];
    }

    public function getScopedQuery(): Builder
    {
        return tap($this->query(), function (Builder $query) {
            $uses = array_flip(class_uses_recursive(static::class));

            if (isset($uses[HasFilters::class])) {
                $this->queryWithFilters($this, $query);
            }

            if (isset($uses[HasSorts::class])) {
                $this->queryWithSorts($this, $query);
            }
        });
    }

    public function getColumnCollection(): Collection
    {
        if (is_string($columns = $this->columns()) || $columns instanceof Model) {
            throw_unless(class_exists($columns), "Class used to get the array of columns not found: $columns");

            throw_unless(
                condition: in_array(TabulatorModel::class, class_implements($columns), true),
                exception: "Class used to get the array of columns does not implement TabulatorModel: $columns",
            );

            $columns = $columns::tabulatorColumns();
        }

        $columns = Collection::wrap($columns);

        return $columns->when(
            value: count($this->actions()) > 0
            && ($columns->doesntContain('field', 'actions')
                || $columns->doesntContain('formatter', 'actions')),
            callback: function (Collection $columns) {
                $actions = Column::make(config('tabulator.action', 'actions'))
                    ->formatterParams(['actions' => array_filter($this->actions())]);

                return $columns->push($actions);
            }
        );
    }

    public function getFieldColumn(string $field): ?Column
    {
        return $this->getColumnCollection()->where('field', $field)->first();
    }

    public function json(): LengthAwarePaginator|Arrayable|Jsonable|array
    {
        $query = $this->getScopedQuery();

        if ($this->options('pagination', false) && $this->options('paginationMode') === 'remote') {
            $pageSize = $this->request->input('size');
            if ($pageSize === 'true') {
                $pageSize = $query->count();
            }

            return $query->paginate($pageSize);
        }

        return $query->get();
    }
}
