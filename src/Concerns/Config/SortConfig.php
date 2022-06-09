<?php

namespace FmTod\LaravelTabulator\Concerns\Config;

trait SortConfig
{
    /**
     * Array of sorters to be applied on load.
     *
     * @param  array  $initialSort
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
     * @param  bool  $sortOrderReverse
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
     * @param  string  $headerSortElement
     * @return \FmTod\LaravelTabulator\Concerns\Config\SortConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function headerSortElement(string $headerSortElement): self
    {
        $this->attributes['headerSortElement'] = $headerSortElement;

        return $this;
    }
}
