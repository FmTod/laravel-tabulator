<?php

namespace FmTod\LaravelTabulator\Concerns\Config;

/**
 * @codeCoverageIgnore
 */
trait PersistenceConfig
{
    /**
     * Define which table data should be persisted.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\PersistenceConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function persistence(bool|array $persistence): self
    {
        $this->attributes['persistence'] = $persistence;

        return $this;
    }

    /**
     * ID tag used to identify persistent storage information.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\PersistenceConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function persistenceID(string $persistenceID): self
    {
        $this->attributes['persistenceID'] = $persistenceID;

        return $this;
    }

    /**
     * Store persistence information in a cookie or localStorage.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\PersistenceConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function persistenceMode(bool|string $persistenceMode): self
    {
        $this->attributes['persistenceMode'] = $persistenceMode;

        return $this;
    }

    /**
     * Override persistence reader functionality to read from custom package.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\PersistenceConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function persistenceReaderFunc(string $persistenceReaderFunc): self
    {
        $this->attributes['persistenceReaderFunc'] = $persistenceReaderFunc;

        return $this;
    }

    /**
     * Override persistence writer functionality to write to custom package.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\PersistenceConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function persistenceWriterFunc(string $persistenceWriterFunc): self
    {
        $this->attributes['persistenceWriterFunc'] = $persistenceWriterFunc;

        return $this;
    }
}
