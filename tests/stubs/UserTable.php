<?php

namespace FmTod\LaravelTabulator\Tests\stubs;

use FmTod\LaravelTabulator\Concerns\HasFilters;
use FmTod\LaravelTabulator\Concerns\HasSorts;
use FmTod\LaravelTabulator\Facades\Tabulator;
use FmTod\LaravelTabulator\Helpers\Column;
use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
use FmTod\LaravelTabulator\TabulatorTable;
use FmTod\LaravelTabulator\Tests\stubs\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserTable extends TabulatorTable
{
    use HasFilters;
    use HasSorts;

    public function config(): TabulatorConfig
    {
        return Tabulator::config()
            ->layout('fitColumns')
            ->pagination(true)
            ->paginationMode('remote')
            ->paginationSize(5)
            ->placeholder('No Data')
            ->filterMode('remote');
    }

    public function query(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('first_name')->title('First Name'),
            Column::make('middle_name')->title('Middle Name'),
            Column::make('last_name')->title('Last Name'),
            Column::make('company')->title('Company'),
            Column::make('email')->title('Email'),
            Column::make('phone')->title('Phone'),
        ];
    }
}
