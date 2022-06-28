<?php

namespace FmTod\LaravelTabulator\Contracts;

use FmTod\LaravelTabulator\TabulatorTable;
use Illuminate\Database\Eloquent\Builder;

interface SortsTable
{
    public function __invoke(TabulatorTable $table, Builder $query, ?array $sorts): Builder;
}
