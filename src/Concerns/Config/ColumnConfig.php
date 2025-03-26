<?php

namespace FmTod\LaravelTabulator\Concerns\Config;

/**
 * @codeCoverageIgnore
 */
trait ColumnConfig
{
    /**
     * define any default options that should be applied to all columns.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function columnDefaults(array $columnDefaults): self
    {
        $this->attributes['columnDefaults'] = $columnDefaults;

        return $this;
    }

    /**
     * Automatically generate column definitions for the table based on the structure of the first row of data.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function autoColumns(bool $autoColumns): self
    {
        $this->attributes['autoColumns'] = $autoColumns;

        return $this;
    }

    /**
     * Manipulate the automatically generated column definitions.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function autoColumnsDefinitions(string|array $autoColumnsDefinitions): self
    {
        $this->attributes['autoColumnsDefinitions'] = $autoColumnsDefinitions;

        return $this;
    }

    /**
     * Layout mode for the table columns.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function layout(string $layout): self
    {
        $this->attributes['layout'] = $layout;

        return $this;
    }

    /**
     * Change column widths to match data when loaded into table.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function layoutColumnsOnNewData(bool $layoutColumnsOnNewData): self
    {
        $this->attributes['layoutColumnsOnNewData'] = $layoutColumnsOnNewData;

        return $this;
    }

    /**
     * Automatically hide/show columns to fit the width of the Tabulator element.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function responsiveLayout(bool $responsiveLayout): self
    {
        $this->attributes['responsiveLayout'] = $responsiveLayout;

        return $this;
    }

    /**
     * show collapsed column list.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function responsiveLayoutCollapseStartOpen(bool $responsiveLayoutCollapseStartOpen): self
    {
        $this->attributes['responsiveLayoutCollapseStartOpen'] = $responsiveLayoutCollapseStartOpen;

        return $this;
    }

    /**
     * use formatters in collapsed column lists.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function responsiveLayoutCollapseUseFormatters(bool $responsiveLayoutCollapseUseFormatters): self
    {
        $this->attributes['responsiveLayoutCollapseUseFormatters'] = $responsiveLayoutCollapseUseFormatters;

        return $this;
    }

    /**
     * create contents of collapsed column list.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function responsiveLayoutCollapseFormatter(string $responsiveLayoutCollapseFormatter): self
    {
        $this->attributes['responsiveLayoutCollapseFormatter'] = $responsiveLayoutCollapseFormatter;

        return $this;
    }

    /**
     * Allow users to move and reorder columns.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function movableColumns(bool $movableColumns): self
    {
        $this->attributes['movableColumns'] = $movableColumns;

        return $this;
    }

    /**
     * Vertical alignment for contents of column header (used in column grouping).
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function columnHeaderVertAlign(string $columnHeaderVertAlign): self
    {
        $this->attributes['columnHeaderVertAlign'] = $columnHeaderVertAlign;

        return $this;
    }

    /**
     * Default column position after scrollToColumn.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function scrollToColumnPosition(string $scrollToColumnPosition): self
    {
        $this->attributes['scrollToColumnPosition'] = $scrollToColumnPosition;

        return $this;
    }

    /**
     * Allow currently visible columns to be scrolled to.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function scrollToColumnIfVisible(bool $scrollToColumnIfVisible): self
    {
        $this->attributes['scrollToColumnIfVisible'] = $scrollToColumnIfVisible;

        return $this;
    }

    /**
     * Where to show column calcs in table.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function columnCalcs(string|bool $columnCalcs): self
    {
        $this->attributes['columnCalcs'] = $columnCalcs;

        return $this;
    }

    /**
     * Character used to separate nested fields in column definition.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function nestedFieldSeparator(string|bool $nestedFieldSeparator): self
    {
        $this->attributes['nestedFieldSeparator'] = $nestedFieldSeparator;

        return $this;
    }

    /**
     * Disable column header bar.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function headerVisible(bool $headerVisible): self
    {
        $this->attributes['headerVisible'] = $headerVisible;

        return $this;
    }

    /**
     * Maintain total column width when resizing a column.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ColumnConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function resizableColumnFit(bool $resizableColumnFit): self
    {
        $this->attributes['resizableColumnFit'] = $resizableColumnFit;

        return $this;
    }
}
