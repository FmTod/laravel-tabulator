<?php

namespace FmTod\LaravelTabulator\Contracts;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

interface RendersTable
{
    public function render(string $view, array $data = []): Response|Responsable;
}
