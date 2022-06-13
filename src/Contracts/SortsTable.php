<?php

namespace FmTod\LaravelTabulator\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface SortsTable
{
    public function __invoke(Builder $query, ?array $sorts): Builder;
}
