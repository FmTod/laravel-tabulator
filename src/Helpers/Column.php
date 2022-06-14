<?php

namespace FmTod\LaravelTabulator\Helpers;

use FmTod\LaravelTabulator\Enums\ColumnSorter;
use Illuminate\Support\Fluent;

/**
 * Tabulator column representation.
 *
 * @property string $title
 * @property string $field
 * @property bool $visible
 * @property string|null $tooltip
 * @property string|null $cssClass
 * @property bool|null $resizable
 * @property bool|null $rowHandle
 * @property bool|null $frozen
 * @property bool|null $print
 * @property bool|null $clipboard
 * @property bool|null $htmlOutput
 * @property int|null $responsive
 * @property string|int|float|null $width
 * @property string|int|float|null $minWidth
 * @property string|int|float|null $maxWidth
 * @property string|int|float|null $maxInitialWidth
 * @property string|null $formatter
 * @property ColumnSorter|null $sorter
 * @property array|null $sorterParams
 * @property bool|string|null $headerFilter
 * @property string|null $headerFilterFunc
 * @property string|null $headerFilterPlaceholder
 * @property array|null $headerFilterParams
 *
 * @codeCoverageIgnore
 */
class Column extends Fluent
{
    /**
     * Make a new column instance.
     *
     * @param  array|string  $options
     * @return static
     */
    public static function make(array|string $options = []): static
    {
        if (is_string($options)) {
            return new static([
                'title' => ucwords($options),
                'field' => $options,
                'visible' => true,
            ]);
        }

        return new static($options);
    }

    /**
     * Convert the fluent instance to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(
            $this->attributes,
            $this->sorter ? ['sorter' => $this->sorter?->value] : []
        );
    }

    //<editor-fold desc="General" defaultstate="collapsed">

    /**
     * This is the title that will be displayed in the header for this column.
     *
     * @param  string  $title
     * @return $this
     */
    public function title(string $title): self
    {
        $this->attributes['title'] = $title;

        return $this;
    }

    /**
     *  This is the key for this column in the data array.
     *
     * @param  string  $field
     * @return $this
     */
    public function field(string $field): self
    {
        $this->attributes['field'] = $field;

        return $this;
    }

    /**
     * Determines if the column is visible.
     *
     * @param  bool  $visible
     * @return $this
     */
    public function visible(bool $visible = true): self
    {
        $this->attributes['visible'] = $visible;

        return $this;
    }

    //</editor-fold>

    //<editor-fold desc="Layout" defaultstate="collapsed">

    /**
     * Sets the on hover tooltip for each cell in this column.
     *
     * @param  string  $tooltip
     * @return $this
     */
    public function tooltip(string $tooltip): self
    {
        $this->attributes['tooltip'] = $tooltip;

        return $this;
    }

    /**
     * Sets css classes on header and cells in this column.
     *
     * Note: Value should be a string containing space separated class names
     *
     * @param  string  $class
     * @return $this
     */
    public function cssClass(string $class): self
    {
        $this->attributes['cssClass'] = $class;

        return $this;
    }

    /**
     * Set whether column can be resized by user dragging its edges.
     *
     * @param  bool  $resizable
     * @return $this
     */
    public function resizable(bool $resizable = true): self
    {
        $this->attributes['resizable'] = $resizable;

        return $this;
    }

    /**
     * Sets the column as a row handle, allowing it to be used to drag movable rows.
     *
     * @param  bool  $rowHandle
     * @return $this
     */
    public function rowHandle(bool $rowHandle = true): self
    {
        $this->attributes['rowHandle'] = $rowHandle;

        return $this;
    }

    /**
     * Freezes the column in place when scrolling.
     *
     * @param  bool  $frozen
     * @return $this
     */
    public function frozen(bool $frozen = true): self
    {
        $this->attributes['frozen'] = $frozen;

        return $this;
    }

    /**
     * Show or hide column in the print output.
     *
     * @param  bool  $print
     * @return $this
     */
    public function print(bool $print = true): self
    {
        $this->attributes['print'] = $print;

        return $this;
    }

    /**
     * Show or hide column in the clipboard output.
     *
     * @param  bool  $clipboard
     * @return $this
     */
    public function clipboard(bool $clipboard = true): self
    {
        $this->attributes['clipboard'] = $clipboard;

        return $this;
    }

    /**
     * Show or hide column in the getHtml function output.
     *
     * @param  bool  $htmlOutput
     * @return $this
     */
    public function htmlOutput(bool $htmlOutput = true): self
    {
        $this->attributes['htmlOutput'] = $htmlOutput;

        return $this;
    }

    /**
     * An integer to determine when the column should be hidden in responsive mode.
     *
     * @param  int  $responsive
     * @return $this
     */
    public function responsive(int $responsive): self
    {
        $this->attributes['responsive'] = $responsive;

        return $this;
    }

    /**
     * Sets the width of this column, this can be set in pixels or as a percentage of total table width.
     *
     * Note: if not set the system will determine the best.
     *
     * @param  string|int|float  $title
     * @return $this
     */
    public function width(string|int|float $title): self
    {
        $this->attributes['title'] = $title;

        return $this;
    }

    /**
     * Sets the minimum width of this column, this should be set in pixels.
     *
     * @param  string|int|float  $minWidth
     * @return $this
     */
    public function minWidth(string|int|float $minWidth): self
    {
        $this->attributes['minWidth'] = $minWidth;

        return $this;
    }

    /**
     * Sets the maximum width of this column, this should be set in pixels.
     *
     * @param  string|int|float  $maxWidth
     * @return $this
     */
    public function maxWidth(string|int|float $maxWidth): self
    {
        $this->attributes['maxWidth'] = $maxWidth;

        return $this;
    }

    /**
     * Sets the maximum width of this column when it is first rendered, the user can
     * then resize to above this (up to the maxWidth, if set) this should be set in pixels.
     *
     * @param  string|int|float  $maxInitialWidth
     * @return $this
     */
    public function maxInitialWidth(string|int|float $maxInitialWidth): self
    {
        $this->attributes['maxInitialWidth'] = $maxInitialWidth;

        return $this;
    }

    //</editor-fold>

    //<editor-fold desc="Data Manipulation" defaultstate="collapsed">

    /**
     * Set how you would like the data to be formatted.
     *
     * @param  string  $formatter
     * @return $this
     */
    public function formatter(string $formatter): self
    {
        $this->attributes['formatter'] = $formatter;

        return $this;
    }

    /**
     * Additional parameters you can pass to the formatter.
     *
     * @param  array  $formatterParams
     * @return $this
     */
    public function formatterParams(array $formatterParams): self
    {
        $this->attributes['formatterParams'] = $formatterParams;

        return $this;
    }

    /**
     * Determines how to sort data in this column.
     *
     * @param  \FmTod\LaravelTabulator\Enums\ColumnSorter  $sorter
     * @return $this
     */
    public function sorter(ColumnSorter $sorter): self
    {
        $this->attributes['sorter'] = $sorter;

        return $this;
    }

    /**
     * Additional parameters you can pass to the sorter.
     *
     * @param  array  $params
     * @return $this
     */
    public function sorterParams(array $params): self
    {
        $this->attributes['sorterParams'] = $params;

        return $this;
    }

    //</editor-fold>

    //<editor-fold desc="Column Headers" defaultstate="collapsed">

    /**
     * Filtering of columns from elements in the header.
     *
     * @param  bool|string  $filter
     * @return $this
     */
    public function headerFilter(bool|string $filter = true): self
    {
        $this->attributes['headerFilter'] = $filter;

        return $this;
    }

    /**
     * The filter function that should be used by the header filter.
     *
     * @param  string  $function
     * @return $this
     */
    public function headerFilterFunc(string $function): self
    {
        $this->attributes['headerFilterFunc'] = $function;

        return $this;
    }

    /**
     * Placeholder text for the header filter.
     *
     * @param  string  $placeholder
     * @return $this
     */
    public function headerFilterPlaceholder(string $placeholder): self
    {
        $this->attributes['headerFilterPlaceholder'] = $placeholder;

        return $this;
    }

    /**
     * Additional parameters you can pass to the header filter.
     *
     * @param  array  $params
     * @return $this
     */
    public function headerFilterParams(array $params): self
    {
        $this->attributes['headerFilterParams'] = $params;

        return $this;
    }

    //</editor-fold>
}
