<?php

namespace FmTod\LaravelTabulator\Concerns;

use FmTod\LaravelTabulator\Contracts\RendersTable;
use FmTod\LaravelTabulator\Renderer\BladeRenderer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait RenderableTable
{
    public function options(?string $key = null, mixed $default = null): mixed
    {
        $options = $this->config()->build($this->request->fullUrl());

        return data_get($options, $key, $default);
    }

    public function data($data = []): array
    {
        $options = $this->optionsKey ?? config('tabulator.variable');

        return array_merge([$options => [
            'columns' => $this->getColumnCollection()->toArray(),
            'options' => $this->options(),
        ]], $data);
    }

    public function render(string $view, $data = [], RendersTable|string|null $renderer = null): mixed
    {
        if (is_null($renderer)) {
            /** @noinspection CallableParameterUseCaseInTypeContextInspection */
            $renderer = config('tabulator.renderer');
        }

        if (is_string($renderer)) {
            /** @noinspection CallableParameterUseCaseInTypeContextInspection */
            $renderer = app($renderer);
        }

        return $renderer->render($this, $view, $data);
    }

    public static function view(string $view, $data = []): Response|JsonResponse
    {
        return app(static::class)->render($view, $data, BladeRenderer::class);
    }
}
