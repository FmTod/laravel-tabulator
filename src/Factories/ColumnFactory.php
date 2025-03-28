<?php

namespace FmTod\LaravelTabulator\Factories;

use FmTod\LaravelTabulator\Helpers\Column;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Support\Traits\Macroable;

/**
 * @mixin \FmTod\LaravelTabulator\Helpers\Column
 */
class ColumnFactory
{
    use ForwardsCalls;
    use Macroable { __call as macroCall; }

    protected Column $column;

    public function __construct(string|array $options = [])
    {
        $this->column = Column::make($options);
    }

    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        return $this->forwardDecoratedCallTo($this->column, $method, $parameters);
    }

    public function __clone()
    {
        $this->column = clone $this->column;
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

    public function clone(): ColumnFactory
    {
        return clone $this;
    }
}
