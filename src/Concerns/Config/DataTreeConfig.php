<?php

namespace FmTod\LaravelTabulator\Concerns\Config;

trait DataTreeConfig
{
    /**
     * Enable tree layout.
     *
     * @param  bool  $dataTree
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataTreeConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataTree(bool $dataTree): self
    {
        $this->attributes['dataTree'] = $dataTree;

        return $this;
    }

    /**
     * Enable filtering of child rows.
     *
     * @param	bool	$dataTreeFilter
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataTreeConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataTreeFilter(bool $dataTreeFilter): self
    {
        $this->attributes['dataTreeFilter'] = $dataTreeFilter;

        return $this;
    }

    /**
     * Enable sorting of child rows.
     *
     * @param	bool	$dataTreeSort
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataTreeConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataTreeSort(bool $dataTreeSort): self
    {
        $this->attributes['dataTreeSort'] = $dataTreeSort;

        return $this;
    }

    /**
     * Choose which column to display the toggle element in.
     *
     * @param	string|bool	$dataTreeElementColumn
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataTreeConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataTreeElementColumn(string|bool $dataTreeElementColumn): self
    {
        $this->attributes['dataTreeElementColumn'] = $dataTreeElementColumn;

        return $this;
    }

    /**
     * Show tree branch icon.
     *
     * @param	bool	$dataTreeBranchElement
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataTreeConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataTreeBranchElement(bool $dataTreeBranchElement): self
    {
        $this->attributes['dataTreeBranchElement'] = $dataTreeBranchElement;

        return $this;
    }

    /**
     * Tree level indent in pixels.
     *
     * @param	int	$dataTreeChildIndent
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataTreeConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataTreeChildIndent(int $dataTreeChildIndent): self
    {
        $this->attributes['dataTreeChildIndent'] = $dataTreeChildIndent;

        return $this;
    }

    /**
     * The data field to look for child rows.
     *
     * @param	string	$dataTreeChildField
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataTreeConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataTreeChildField(string $dataTreeChildField): self
    {
        $this->attributes['dataTreeChildField'] = $dataTreeChildField;

        return $this;
    }

    /**
     * The element to be used for the collapse toggle button.
     *
     * @param	bool|string	$dataTreeCollapseElement
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataTreeConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataTreeCollapseElement(bool|string $dataTreeCollapseElement): self
    {
        $this->attributes['dataTreeCollapseElement'] = $dataTreeCollapseElement;

        return $this;
    }

    /**
     * The element to be used for the expand toggle button.
     *
     * @param	bool|string	$dataTreeExpandElement
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataTreeConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataTreeExpandElement(bool|string $dataTreeExpandElement): self
    {
        $this->attributes['dataTreeExpandElement'] = $dataTreeExpandElement;

        return $this;
    }

    /**
     * The default expansion state for tree nodes.
     *
     * @param	bool|array|string	$dataTreeStartExpanded
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataTreeConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataTreeStartExpanded(bool|array|string $dataTreeStartExpanded): self
    {
        $this->attributes['dataTreeStartExpanded'] = $dataTreeStartExpanded;

        return $this;
    }

    /**
     * Allow selection of a row to propagate to its children.
     *
     * @param	bool	$dataTreeSelectPropagate
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataTreeConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataTreeSelectPropagate(bool $dataTreeSelectPropagate): self
    {
        $this->attributes['dataTreeSelectPropagate'] = $dataTreeSelectPropagate;

        return $this;
    }

    /**
     * Include visible child rows in column calculations.
     *
     * @param	bool	$dataTreeChildColumnCalcs
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataTreeConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataTreeChildColumnCalcs(bool $dataTreeChildColumnCalcs): self
    {
        $this->attributes['dataTreeChildColumnCalcs'] = $dataTreeChildColumnCalcs;

        return $this;
    }
}
