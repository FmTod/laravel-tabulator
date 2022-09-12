<?php

namespace FmTod\LaravelTabulator\Renderer;

use FmTod\LaravelTabulator\Contracts\RendersTable;
use FmTod\LaravelTabulator\TabulatorTable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BladeRenderer implements RendersTable
{
    public function render(TabulatorTable $table, string $view, Arrayable|array $data = []): Response|JsonResponse
    {
        if ($table->request->ajax() || $table->request->wantsJson()) {
            return response()->json($table->json());
        }

        return response()->view($view, $table->data($data));
    }
}
