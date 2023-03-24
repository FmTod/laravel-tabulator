<?php

namespace FmTod\LaravelTabulator\Concerns;

trait InitializeTraits
{
    protected function initializeTraits(): void
    {
        $traits = class_uses_recursive(static::class);

        foreach ($traits as $trait) {
            $method = 'initialize'.class_basename($trait);

            if (method_exists($this, $method)) {
                $this->{$method}();
            }
        }
    }
}
