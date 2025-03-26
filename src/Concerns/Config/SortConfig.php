<?php

namespace FmTod\LaravelTabulator\Concerns\Config;

/**
 * @codeCoverageIgnore
 */
trait SortConfig
{
    /**
     * Array of sorters to be applied on load.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\SortConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function initialSort(array $initialSort): self
    {
        $this->attributes['initialSort'] = $initialSort;

        return $this;
    }

    /**
     * Reverse the order that multiple sorters are applied to the table.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\SortConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function sortOrderReverse(bool $sortOrderReverse): self
    {
        $this->attributes['sortOrderReverse'] = $sortOrderReverse;

        return $this;
    }

    /**
     * set the column header sort icon.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\SortConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function headerSortElement(string $headerSortElement): self
    {
        $this->attributes['headerSortElement'] = $headerSortElement;

        return $this;
    }

    /**
     * Whether to include the table name in the field sorts.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\SortConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function sortsIncludeTableName(bool $includeTableName = true): self
    {
        $this->attributes['sortsIncludeTableName'] = $includeTableName;

        return $this;
    }
}
