<?php

namespace FmTod\LaravelTabulator\Concerns;

use FmTod\LaravelTabulator\Contracts\RendersTable;
use FmTod\LaravelTabulator\Renderer\BladeRenderer;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

trait RenderableTable
{
    public function options(): array
    {
        return $this->config()->build($this->request->fullUrl());
    }

    public function data($data = []): array
    {
        $options = config('tabulator.variable');

        return array_merge([$options => [
            'columns' => $this->getColumnArray(),
            'options' => $this->options(),
        ]], $data);
    }

    public function render(string $view, $data = [], RendersTable|string|null $renderer = null): Responsable|Response|Arrayable|Jsonable
    {
        if ($this->request->ajax() || $this->request->wantsJson()) {
            return $this->json();
        }

        if (is_null($renderer)) {
            $renderer = config('tabulator.renderer');
        }

        if (is_string($renderer)) {
            $renderer = app($renderer);
        }

        return $renderer->render($view, $this->data($data));
    }

    public static function view(string $view, $data = []): Responsable|Response|Arrayable|Jsonable
    {
        return app(static::class)->render($view, $data, BladeRenderer::class);
    }
}
