<?php

namespace FmTod\LaravelTabulator\Concerns;


use Illuminate\Http\Request;

trait HasRequest
{
    public Request $request;

    protected function initializeHasRequest(): void
    {
        $this->request = request();
    }

    public function setRequest(Request $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}
