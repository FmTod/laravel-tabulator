<?php

namespace FmTod\LaravelTabulator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \FmTod\LaravelTabulator\Helpers\TabulatorConfig config(array $options = [])
 * @method static \Illuminate\Database\Eloquent\Model persistenceGet(string $table, string $type)
 * @method static bool persistenceSave(string $table, string $type, array $data)
 * @method static array persistenceTable(string $table)
 * @method static void persistenceRoutes(string $name = 'tabulator.persistence', string $prefix = 'tabulator/persistence')
 */
class Tabulator extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'tabulator';
    }
}
