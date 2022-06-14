<?php

namespace FmTod\LaravelTabulator\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface FiltersByType
{
    public function __invoke(Builder $query, array $filter): Builder;
}