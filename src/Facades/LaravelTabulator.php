<?php

namespace FmTod\LaravelTabulator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \FmTod\LaravelTabulator\LaravelTabulator
 */
class LaravelTabulator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-tabulator';
    }
}
