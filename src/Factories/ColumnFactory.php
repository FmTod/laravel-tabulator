<?php

namespace FmTod\LaravelTabulator\Factories;

use FmTod\LaravelTabulator\Helpers\Column;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;

/**
 * @mixin \FmTod\LaravelTabulator\Helpers\Column
 */
class ColumnFactory
{
    use Macroable { __call as __macroCall; }

    protected Column $column;

    public function __construct(string|array $options = [])
    {
        $this->column = Column::make($options);
    }

    public function __call($method, $parameters)
    {
        if (! method_exists($this->column, $method)) {
            return $this->__macroCall($method, $parameters);
        }

        return $this->column->$method(...$parameters);
    }

    public function make(string|array $options = []): Column
    {
        if (is_string($options)) {
            $options = [
                'title' => Str::of($options)->replace('_', ' ')->title()->toString(),
                'field' => $options,
                'visible' => true,
            ];
        }

        return Column::make(array_merge($this->column->toArray(), $options));
    }
}
