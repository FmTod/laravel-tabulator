<?php

namespace FmTod\LaravelTabulator\Concerns\Config;

trait PaginationConfig
{
    /**
     * Enable pagination.
     *
     * @param  string  $pagination
     * @return \FmTod\LaravelTabulator\Concerns\Config\PaginationConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function pagination(string $pagination): self
    {
        $this->attributes['pagination'] = $pagination;

        return $this;
    }

    /**
     * Send pagination config to server instead of processing locally.
     *
     * @param	string	$paginationMode
     * @return \FmTod\LaravelTabulator\Concerns\Config\PaginationConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function paginationMode(string $paginationMode): self
    {
        $this->attributes['paginationMode'] = $paginationMode;

        return $this;
    }

    /**
     * Set the number of rows in each page.
     *
     * @param	int	$paginationSize
     * @return \FmTod\LaravelTabulator\Concerns\Config\PaginationConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function paginationSize(int $paginationSize): self
    {
        $this->attributes['paginationSize'] = $paginationSize;

        return $this;
    }

    /**
     * Add page size selection select element to the table footer.
     *
     * @param	bool|array	$paginationSizeSelector
     * @return \FmTod\LaravelTabulator\Concerns\Config\PaginationConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function paginationSizeSelector(bool|array $paginationSizeSelector): self
    {
        $this->attributes['paginationSizeSelector'] = $paginationSizeSelector;

        return $this;
    }

    /**
     * The element to contain the pagination selectors.
     *
     * @param	string	$paginationElement
     * @return \FmTod\LaravelTabulator\Concerns\Config\PaginationConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function paginationElement(string $paginationElement): self
    {
        $this->attributes['paginationElement'] = $paginationElement;

        return $this;
    }

    /**
     * Set where rows should be added to the table.
     *
     * @param	string	$paginationAddRow
     * @return \FmTod\LaravelTabulator\Concerns\Config\PaginationConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function paginationAddRow(string $paginationAddRow): self
    {
        $this->attributes['paginationAddRow'] = $paginationAddRow;

        return $this;
    }

    /**
     * set the number of pagination buttons in the footer element.
     *
     * @param	int	$paginationButtonCount
     * @return \FmTod\LaravelTabulator\Concerns\Config\PaginationConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function paginationButtonCount(int $paginationButtonCount): self
    {
        $this->attributes['paginationButtonCount'] = $paginationButtonCount;

        return $this;
    }
}
