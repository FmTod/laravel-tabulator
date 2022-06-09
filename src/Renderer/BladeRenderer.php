<?php

namespace FmTod\LaravelTabulator\Renderer;

use FmTod\LaravelTabulator\Contracts\RendersTable;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class BladeRenderer implements RendersTable
{
    public function render(string $view, array $data = []): Response|Responsable
    {
        return response()->view($view, $data);
    }
}
