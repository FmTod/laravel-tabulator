<?php

namespace FmTod\LaravelTabulator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \FmTod\LaravelTabulator\Helpers\TabulatorConfig config(array $options = [])
 * @method static \Illuminate\Database\Eloquent\Model|null persistenceGet(string $table, string $type)
 * @method static \Illuminate\Database\Eloquent\Model persistenceSave(string $table, string $type, array $data)
 * @method static void persistenceDelete(string $table, string $type)
 * @method static void persistenceClear(string $table)
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
