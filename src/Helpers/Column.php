<?php

namespace FmTod\LaravelTabulator\Helpers;

use Closure;
use FmTod\LaravelTabulator\Enums\ColumnSorter;
use FmTod\LaravelTabulator\Factories\ColumnFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;

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
 * @property string|null $sortField
 * @property string|null $filterField
 * @property Closure|callable|null $sortFunc
 * @property Closure|callable|null $filterFunc
 *
 * @codeCoverageIgnore
 */
class Column extends Fluent
{
    use Macroable { __call as macroCall; }

    /**
     * Create a new column instance.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct(array_merge(
            config('tabulator.defaults.column', []),
            $attributes,
        ));
    }

    /**
     * Make a new column instance.
     *
     * @param  array|string  $options
     * @return static
     */
    public static function make(array|string $options = []): static
    {
        return new static(is_string($options) ? [
            'title' => Str::of($options)->replace('_', ' ')->title()->toString(),
            'field' => $options,
            'visible' => true,
        ] : $options);
    }

    /**
     * Create a column group.
     *
     * @param  string  $title
     * @param  array  $columns
     * @return static
     */
    public static function group(string $title, array $columns): self
    {
        return new static([
            'title' => $title,
            'columns' => $columns,
        ]);
    }

    /**
     * Get a new instance of the column factory.
     *
     * @param  array|string  $options
     * @return \FmTod\LaravelTabulator\Factories\ColumnFactory
     */
    public static function factory(array|string $options = []): ColumnFactory
    {
        return new ColumnFactory($options);
    }

    /**
     * Handle dynamic method calls into the class.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        return parent::__call($method, $parameters);
    }

    /**
     * Deep clones the current instance of the column.
     *
     * @return $this
     */
    public function clone(): static
    {
        return clone $this;
    }

    /**
     * Convert the fluent instance to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $attributes = parent::toArray();

        if ($this->sorter instanceof ColumnSorter) {
            $attributes['sorter'] = $this->sorter->value;
        }

        return Arr::except($attributes, ['sortField', 'sortFunc', 'filterField', 'filterFunc']);
    }

    /**
     * Get a factory instance for the column.
     *
     * @return \FmTod\LaravelTabulator\Factories\ColumnFactory
     */
    public function toFactory(): ColumnFactory
    {
        return Column::factory($this->toArray());
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
     * Sets the horizontal alignment for cells in the column.
     *
     * @param  string  $hozAlign
     * @return $this
     */
    public function hozAlign(string $hozAlign): self
    {
        $this->attributes['hozAlign'] = $hozAlign;

        return $this;
    }

    /**
     * Sets the vertical alignment for cells in the column.
     *
     * @param  string  $vertAlign
     * @return $this
     */
    public function vertAlign(string $vertAlign): self
    {
        $this->attributes['vertAlign'] = $vertAlign;

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
     * @param  string|int|float  $width
     * @return $this
     */
    public function width(string|int|float $width): self
    {
        $this->attributes['width'] = $width;

        return $this;
    }

    /**
     * The widthGrow function works by dividing the available space by the sum total of widthGrow values
     * and then allocating it out to the columns based on their value.
     *
     * The widthGrow property should be used on columns without a width property set. The value is
     * used to work out what fraction of the available will be allocated to the column. The value
     * should be set to a number greater than 0, by default any columns with no width set have a
     * widthGrow value of 1.
     *
     * @param  int  $widthGrow
     * @return $this
     */
    public function widthGrow(int $widthGrow): self
    {
        $this->attributes['widthGrow'] = $widthGrow;

        return $this;
    }

    /**
     * The widthShrink function works by dividing the excess horizontal space by the sum total of widthShrink
     * values and then allocating it out to the columns based on their value.
     *
     * The widthShrink property should be used on columns with a width property set. The value is used
     * to work out how to shrink columns with a fixed width when the table is too narrow to fit in all
     * the columns. The value should be set to a number greater than 0, by default columns with a width
     * set have a widthShrink value of 0, meaning they will not be shrunk if the table gets too narrow,
     * and may cause the horizontal scrollbar to appear.
     *
     * @param  int  $widthShrink
     * @return $this
     */
    public function widthShrink(int $widthShrink): self
    {
        $this->attributes['widthShrink'] = $widthShrink;

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

    /**
     * Sets group of columns to be inserted into a multiline header.
     *
     * @param  array  $columns
     * @return $this
     */
    public function columns(array $columns): self
    {
        $this->attributes['columns'] = $columns;

        return $this;
    }

    //</editor-fold>

    //<editor-fold desc="Data Manipulation" defaultstate="collapsed">

    /**
     * Set how you would like the data to be formatted in the header.
     *
     * @param  string  $titleFormatter
     * @return $this
     */
    public function titleFormatter(string $titleFormatter): self
    {
        $this->attributes['titleFormatter'] = $titleFormatter;

        return $this;
    }

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
    public function sorter(ColumnSorter|string $sorter): self
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

    /**
     * Sets whether the column can be sorted or not.
     *
     * @param  bool  $headerSort
     * @return $this
     */
    public function headerSort(bool $headerSort = true): self
    {
        $this->attributes['headerSort'] = $headerSort;

        return $this;
    }

    /**
     * Set the filed to be used for sorting instead of the default one.
     *
     * @param  string  $sortField
     * @return $this
     */
    public function sortField(string $sortField): self
    {
        $this->attributes['sortField'] = $sortField;

        return $this;
    }

    /**
     * Set a custom sorting function for the column.
     *
     * @param  \Closure|callable  $sortFunc
     * @return $this
     */
    public function sortFunc(Closure|callable $sortFunc): self
    {
        $this->attributes['sortFunc'] = $sortFunc;

        return $this;
    }

    /**
     * Set the column editor.
     *
     * @param  string|bool  $editor
     * @return $this
     */
    public function editor(string|bool $editor): self
    {
        $this->attributes['editor'] = $editor;

        return $this;
    }

    /**
     *  Sets whether the cell is editable or not
     *
     *  Accepts boolean or a callback function that will be called to determine if the cell is editable.
     *
     * @param  string|bool  $editable
     * @return $this
     */
    public function editable(string|bool $editable): self
    {
        $this->attributes['editable'] = $editable;

        return $this;
    }

    /**
     * Column editor options.
     *
     * @param  array  $editorParams
     * @return $this
     */
    public function editorParams(array $editorParams): self
    {
        $this->attributes['editorParams'] = $editorParams;

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
     * Helper function to set the header filter and header filter function to the same value.
     *
     * @param  string  $filter
     * @return $this
     */
    public function headerFilterSet(string $filter): self
    {
        return $this->headerFilter($filter)->headerFilterFunc($filter);
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

    /**
     * Set the filed to be used for filtering instead of the default one.
     *
     * @param  string  $filterField
     * @return $this
     */
    public function filterField(string $filterField): self
    {
        $this->attributes['filterField'] = $filterField;

        return $this;
    }

    /**
     * Set a custom filtering function for the column.
     *
     * @param  \Closure|callable  $filterFunc
     * @return $this
     */
    public function filterFunc(Closure|callable $filterFunc): self
    {
        $this->attributes['filterFunc'] = $filterFunc;

        return $this;
    }

    //</editor-fold>

    //<editor-fold desc="Callbacks" defaultstate="collapsed">

    /**
     * Callback function to be called when the column is edited.
     *
     * @param  string  $cellEdited
     * @return $this
     */
    public function cellEdited(string $cellEdited): self
    {
        $this->attributes['cellEdited'] = $cellEdited;

        return $this;
    }

    /**
     * Callback function to be called when the column is clicked.
     *
     * @param  string  $cellClick
     * @return $this
     */
    public function cellClick(string $cellClick): self
    {
        $this->attributes['cellClick'] = $cellClick;

        return $this;
    }

    //</editor-fold>
}
