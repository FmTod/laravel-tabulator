<?php

namespace FmTod\LaravelTabulator\Concerns\Config;

/**
 * @codeCoverageIgnore
 */
trait RowConfig
{
    /**
     * Set fixed height for rows.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function rowHeight(int $rowHeight): self
    {
        $this->attributes['rowHeight'] = $rowHeight;

        return $this;
    }

    /**
     * Function to alter layout of rows.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function rowFormatter(string|bool $rowFormatter): self
    {
        $this->attributes['rowFormatter'] = $rowFormatter;

        return $this;
    }

    /**
     * Function to alter layout of rows when printed.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function rowFormatterPrint(string|bool $rowFormatterPrint): self
    {
        $this->attributes['rowFormatterPrint'] = $rowFormatterPrint;

        return $this;
    }

    /**
     * Function to alter layout of rows when copied to the clipboard.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function rowFormatterClipboard(string|bool $rowFormatterClipboard): self
    {
        $this->attributes['rowFormatterClipboard'] = $rowFormatterClipboard;

        return $this;
    }

    /**
     * Function to alter layout of rows when the getHtml formatter is called.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function rowFormatterHtmlOutput(string|bool $rowFormatterHtmlOutput): self
    {
        $this->attributes['rowFormatterHtmlOutput'] = $rowFormatterHtmlOutput;

        return $this;
    }

    /**
     * The position in the table for new rows to be added, "bottom" or "top".
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function addRowPos(string $addRowPos): self
    {
        $this->attributes['addRowPos'] = $addRowPos;

        return $this;
    }

    /**
     * Enable/Disable row selection.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function selectable(bool|int|string $selectable): self
    {
        $this->attributes['selectable'] = $selectable;

        return $this;
    }

    /**
     * Allow rolling selection.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function selectableRollingSelection(bool $selectableRollingSelection): self
    {
        $this->attributes['selectableRollingSelection'] = $selectableRollingSelection;

        return $this;
    }

    /**
     * Maintain selected rows on filter or sort.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function selectablePersistence(bool $selectablePersistence): self
    {
        $this->attributes['selectablePersistence'] = $selectablePersistence;

        return $this;
    }

    /**
     * Check if row should be selectable or unselectable.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function selectableCheck(string $selectableCheck): self
    {
        $this->attributes['selectableCheck'] = $selectableCheck;

        return $this;
    }

    /**
     * Set the range select behavior.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function selectableRangeMode(string $selectableRangeMode): self
    {
        $this->attributes['selectableRangeMode'] = $selectableRangeMode;

        return $this;
    }

    /**
     * Allow users to move and reorder rows.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function movableRows(bool $movableRows): self
    {
        $this->attributes['movableRows'] = $movableRows;

        return $this;
    }

    /**
     * Connection selector for receiving tables.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function movableRowsConnectedTables(string $movableRowsConnectedTables): self
    {
        $this->attributes['movableRowsConnectedTables'] = $movableRowsConnectedTables;

        return $this;
    }

    /**
     * Sender function to be executed when row has been sent.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function movableRowsSender(string|bool $movableRowsSender): self
    {
        $this->attributes['movableRowsSender'] = $movableRowsSender;

        return $this;
    }

    /**
     * Sender function to be executed when row has been received.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function movableRowsReceiver(string $movableRowsReceiver): self
    {
        $this->attributes['movableRowsReceiver'] = $movableRowsReceiver;

        return $this;
    }

    /**
     * Connection selector for receiving elements.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function movableRowsConnectedElements(string $movableRowsConnectedElements): self
    {
        $this->attributes['movableRowsConnectedElements'] = $movableRowsConnectedElements;

        return $this;
    }

    /**
     * Callback executed when a table row is dropped on a non Tabulator DOM element.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function movableRowsElementDrop(string $movableRowsElementDrop): self
    {
        $this->attributes['movableRowsElementDrop'] = $movableRowsElementDrop;

        return $this;
    }

    /**
     * Allow user to resize rows (via handles on the top and bottom edges of the row).
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function resizableRows(bool $resizableRows): self
    {
        $this->attributes['resizableRows'] = $resizableRows;

        return $this;
    }

    /**
     * Default row position after scrollToRow.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function scrollToRowPosition(string $scrollToRowPosition): self
    {
        $this->attributes['scrollToRowPosition'] = $scrollToRowPosition;

        return $this;
    }

    /**
     * Allow currently visible rows to be scrolled to.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function scrollToRowIfVisible(bool $scrollToRowIfVisible): self
    {
        $this->attributes['scrollToRowIfVisible'] = $scrollToRowIfVisible;

        return $this;
    }
}
