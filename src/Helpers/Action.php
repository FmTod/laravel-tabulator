<?php

namespace FmTod\LaravelTabulator\Helpers;

use Illuminate\Support\Fluent;
use Illuminate\Support\Traits\Macroable;

/**
 * Class Button
 *
 * @method \FmTod\LaravelTabulator\Helpers\Action tag(string $tag)
 * @method \FmTod\LaravelTabulator\Helpers\Action hidden(string $hidden)
 * @method \FmTod\LaravelTabulator\Helpers\Action class(string $class)
 * @method \FmTod\LaravelTabulator\Helpers\Action style(string $style)
 * @method \FmTod\LaravelTabulator\Helpers\Action href(string $href)
 * @method \FmTod\LaravelTabulator\Helpers\Action role(string $role)
 * @method \FmTod\LaravelTabulator\Helpers\Action innerHTML(string $innerHTML)
 * @method \FmTod\LaravelTabulator\Helpers\Action innerText(string $innerText)
 * @method \FmTod\LaravelTabulator\Helpers\Action onclick(string $onclick)
 */
class Action extends Fluent
{
    use Macroable { __call as macroCall; }

    /**
     * Handle dynamic method calls into the class.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        return parent::__call($method, $parameters);
    }

    /**
     * Create a new action instance.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct(array_merge(
            config('tabulator.defaults.action', []),
            $attributes,
        ));
    }

    /**
     * Make a new action instance.
     *
     * @param  array|string  $options
     * @return static
     */
    public static function make(array|string $options = []): static
    {
        return new static(is_string($options) ? ['innerHTML' => $options] : $options);
    }

    /**
     * Add class to existing class list.
     *
     * @param  string  $class
     * @return $this
     */
    public function addClass(string $class): static
    {
        $this->attributes['class'] .= ' '.$class;

        return $this;
    }
}
