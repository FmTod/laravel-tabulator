<?php

namespace FmTod\LaravelTabulator\Concerns;

use FmTod\LaravelTabulator\Contracts\RendersTable;
use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
use FmTod\LaravelTabulator\Renderer\BladeRenderer;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

trait RenderableTable
{
    protected function options(): array
    {
        return tap($this->config(), function (TabulatorConfig $config) {
            if (is_null($config->ajaxURL)) {
                $config->ajaxURL($this->request->fullUrl());
            }

            if (is_null($config->columns)) {
                $columns = collect($this->columns())->toArray();

                $config->columns($columns);
            }
        })->toArray();
    }

    protected function data($data = []): array
    {
        $options = config('tabulator.variable');

        return array_merge([$options => $this->options()], $data);
    }

    protected function render(string $view, $data = [], RendersTable|string $renderer = RendersTable::class): Responsable|Response
    {
        if (! $renderer instanceof RendersTable) {
            $renderer = app()->make($renderer);
        }

        return $renderer->render($view, $this->data($data));
    }

    public static function view(string $view, $data = []): Responsable|Response
    {
        return app(static::class)->render($view, $data, BladeRenderer::class);
    }
}
