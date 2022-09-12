<?php

namespace FmTod\LaravelTabulator\Contracts;

use FmTod\LaravelTabulator\TabulatorTable;
use Illuminate\Contracts\Support\Arrayable;

interface RendersTable
{
    public function render(TabulatorTable $table, string $view, Arrayable|array $data = []);
}
