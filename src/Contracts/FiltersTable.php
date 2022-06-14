<?php

namespace FmTod\LaravelTabulator\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface FiltersTable
{
    public function __invoke(Builder $query, ?array $filters): Builder;
}