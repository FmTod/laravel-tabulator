<?php

namespace FmTod\LaravelTabulator\Contracts;

use FmTod\LaravelTabulator\TabulatorTable;
use Illuminate\Database\Eloquent\Builder;

interface FiltersTable
{
    public function __invoke(TabulatorTable $table, Builder $query, ?array $filters): Builder;
}
