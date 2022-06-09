<?php

namespace FmTod\LaravelTabulator\Facades;

use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
use Illuminate\Support\Facades\Facade;

/**
 * @method static TabulatorConfig config(array $options = [])
 */
class Tabulator extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'tabulator';
    }
}
