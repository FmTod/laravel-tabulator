<?php

namespace FmTod\LaravelTabulator\Concerns;

use Illuminate\Support\Collection;

trait HasParameters
{
    public Collection $parameters;

    protected function initializeHasParameters(): void
    {
        $this->parameters = new Collection();
    }

    public function setAllParameters(Collection|array $params): self
    {
        $this->parameters = collect($params);

        return $this;
    }

    public function getAllParameters(): Collection
    {
        return $this->parameters;
    }

    public function setParameter(string $name, mixed $value): self
    {
        $this->parameters->put($name, $value);

        return $this;
    }

    public function getParameter(string $name, mixed $default = null): mixed
    {
        return $this->parameters->get($name, $default);
    }
}
