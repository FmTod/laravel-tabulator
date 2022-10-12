<?php

namespace FmTod\LaravelTabulator\Helpers;

use Illuminate\Support\Fluent;
use Illuminate\Support\Traits\Macroable;

/**
 * Class Button
 *
 * @method static tag(string $tag)
 * @method static hidden(string $hidden)
 * @method static class(string $class)
 * @method static style(string $style)
 * @method static href(string $href)
 * @method static role(string $role)
 * @method static innerHTML(string $innerHTML)
 * @method static innerText(string $innerText)
 * @method static onclick(string $onclick)
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
}
