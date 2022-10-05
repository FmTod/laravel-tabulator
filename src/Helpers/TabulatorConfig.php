<?php

namespace FmTod\LaravelTabulator\Helpers;

use FmTod\LaravelTabulator\Concerns\Config\ClipboardConfig;
use FmTod\LaravelTabulator\Concerns\Config\ColumnConfig;
use FmTod\LaravelTabulator\Concerns\Config\DataConfig;
use FmTod\LaravelTabulator\Concerns\Config\DataTreeConfig;
use FmTod\LaravelTabulator\Concerns\Config\FilterConfig;
use FmTod\LaravelTabulator\Concerns\Config\MenuConfig;
use FmTod\LaravelTabulator\Concerns\Config\PaginationConfig;
use FmTod\LaravelTabulator\Concerns\Config\PersistenceConfig;
use FmTod\LaravelTabulator\Concerns\Config\PrintConfig;
use FmTod\LaravelTabulator\Concerns\Config\RowConfig;
use FmTod\LaravelTabulator\Concerns\Config\RowGroupConfig;
use FmTod\LaravelTabulator\Concerns\Config\SortConfig;
use FmTod\LaravelTabulator\TabulatorTable;
use Illuminate\Support\Fluent;
use Illuminate\Support\Traits\Macroable;

/**
 * Tabulator configuration instance.
 *
 * @property string|int|null $height
 * @property string|int|null $minHeight
 * @property string|int|null $maxHeight
 * @property string|null $renderVertical
 * @property int|null $renderVerticalBuffer
 * @property string|null $renderHorizontal
 * @property string|null $placeholder
 * @property string|null $footerElement
 * @property bool|string|null $history
 * @property bool|string|null $keybindings
 * @property string|bool|null $locale
 * @property array|null $langs
 * @property array|null $downloadConfig
 * @property string|null $downloadRowRange
 * @property array|null $htmlOutputConfig
 * @property bool|null $reactiveData
 * @property bool|array|string|null $tabEndNewRow
 * @property string|null $validationMode
 * @property string|null $textDirection
 * @property bool|null $debugInvalidOptions
 * @property bool|string|null $popupContainer
 * @property array|null $columns
 * @property array|null $columnDefaults
 * @property bool|null $autoColumns
 * @property string|array|null $autoColumnsDefinitions
 * @property string|null $layout
 * @property bool|null $layoutColumnsOnNewData
 * @property bool|null $responsiveLayout
 * @property bool|null $responsiveLayoutCollapseStartOpen
 * @property bool|null $responsiveLayoutCollapseUseFormatters
 * @property string|null $responsiveLayoutCollapseFormatter
 * @property bool|null $movableColumns
 * @property string|null $columnHeaderVertAlign
 * @property string|null $scrollToColumnPosition
 * @property bool|null $scrollToColumnIfVisible
 * @property string|bool|null $columnCalcs
 * @property string|bool|null $nestedFieldSeparator
 * @property bool|null $headerVisible
 * @property bool|null $resizableColumnFit
 * @property int|null $rowHeight
 * @property string|bool|null $rowFormatter
 * @property string|bool|null $rowFormatterPrint
 * @property string|bool|null $rowFormatterClipboard
 * @property string|bool|null $rowFormatterHtmlOutput
 * @property string|null $addRowPos
 * @property bool|int|string|null $selectable
 * @property bool|null $selectableRollingSelection
 * @property bool|null $selectablePersistence
 * @property string|null $selectableCheck
 * @property bool|null $movableRows
 * @property string|null $movableRowsConnectedTables
 * @property string|bool|null $movableRowsSender
 * @property string|null $movableRowsReceiver
 * @property string|null $movableRowsConnectedElements
 * @property string|null $movableRowsElementDrop
 * @property bool|null $resizableRows
 * @property string|null $scrollToRowPosition
 * @property bool|null $scrollToRowIfVisible
 * @property string|null $index
 * @property array|null $data
 * @property string|bool|null $ajaxURL
 * @property array|null $ajaxParams
 * @property string|array|null $ajaxConfig
 * @property string|array|null $ajaxContentType
 * @property string|null $ajaxURLGenerator
 * @property string|null $ajaxRequestFunc
 * @property array|null $dataSendParams
 * @property string|null $filterMode
 * @property string|null $sortMode
 * @property bool|null $progressiveLoad
 * @property int|null $progressiveLoadDelay
 * @property int|null $progressiveLoadScrollMargin
 * @property string|null $importFormat
 * @property string|null $importReader
 * @property bool|string|null $dataLoader
 * @property string|null $dataLoaderLoading
 * @property string|null $dataLoaderError
 * @property int|null $dataLoaderErrorTimeout
 * @property array|null $initialSort
 * @property bool|null $sortOrderReverse
 * @property string|null $headerSortElement
 * @property array|null $initialFilter
 * @property array|null $initialHeaderFilter
 * @property int|null $headerFilterLiveFilterDelay
 * @property string|array|null $groupBy
 * @property array|null $groupValues
 * @property string|array|null $groupHeader
 * @property string|array|null $groupHeaderPrint
 * @property string|array|null $groupHeaderClipboard
 * @property string|array|null $groupHeaderDownload
 * @property string|array|null $groupHeaderHtmlOutput
 * @property bool|string|array|null $groupStartOpen
 * @property string|bool|null $groupToggleElement
 * @property bool|null $groupClosedShowCalcs
 * @property string|null $pagination
 * @property string|null $paginationMode
 * @property int|null $paginationSize
 * @property bool|array|null $paginationSizeSelector
 * @property string|null $paginationElement
 * @property string|null $paginationAddRow
 * @property int|null $paginationButtonCount
 * @property bool|array|null $persistence
 * @property string|null $persistenceID
 * @property bool|string|null $persistenceMode
 * @property string|null $persistenceReaderFunc
 * @property string|null $persistenceWriterFunc
 * @property bool|null $clipboard
 * @property string|null $clipboardCopyRowRange
 * @property string|null $clipboardCopyFormatter
 * @property string|null $clipboardPasteParser
 * @property string|null $clipboardPasteAction
 * @property bool|null $dataTree
 * @property bool|null $dataTreeFilter
 * @property bool|null $dataTreeSort
 * @property string|bool|null $dataTreeElementColumn
 * @property bool|null $dataTreeBranchElement
 * @property int|null $dataTreeChildIndent
 * @property string|null $dataTreeChildField
 * @property bool|string|null $dataTreeCollapseElement
 * @property bool|string|null $dataTreeExpandElement
 * @property bool|array|string|null $dataTreeStartExpanded
 * @property bool|null $dataTreeSelectPropagate
 * @property bool|null $dataTreeChildColumnCalcs
 * @property bool|null $printAsHtml
 * @property bool|null $printStyled
 * @property string|null $printRowRange
 * @property array|null $printConfig
 * @property bool|string|null $printHeader
 * @property bool|string|null $printFooter
 * @property string|bool|null $printFormatter
 * @property array|null $rowContextMenu
 * @property array|null $rowClickMenu
 * @property array|null $groupContextMenu
 * @property array|null $groupClickMenu
 *
 * @codeCoverageIgnore
 */
class TabulatorConfig extends Fluent
{
    use ColumnConfig;
    use RowConfig;
    use DataConfig;
    use SortConfig;
    use FilterConfig;
    use RowGroupConfig;
    use PaginationConfig;
    use PersistenceConfig;
    use ClipboardConfig;
    use DataTreeConfig;
    use PrintConfig;
    use MenuConfig;
    use Macroable { __call as macroCall; }

    public function __construct(array $options = [])
    {
        parent::__construct(array_merge(
            [
                'pagination' => true,
                'sortMode' => 'remote',
                'filterMode' => 'remote',
                'paginationMode' => 'remote',
            ],
            $this->getPersistenceConfig(),
            config('tabulator.defaults.config', []),
            $options
        ));
    }

    protected function guessTableClass(): ?string
    {
        $backtrace = debug_backtrace(limit: 10);

        foreach ($backtrace as $item) {
            if (isset($item['object']) && $item['object'] instanceof TabulatorTable) {
                return $item['class'];
            }
        }

        return null;
    }

    protected function getPersistenceConfig(): array
    {
        $persistence = config('tabulator.persistence.enabled', false);

        if (! $persistence) {
            return [];
        }

        $persistenceId = $this->guessTableClass();

        return array_merge($persistenceId ? ['persistenceID' => $persistenceId] : [], [
            'persistence' => $persistence,
            'persistenceMode' => 'remote',
        ]);
    }

    public function build($ajaxUrl): array
    {
        if (is_null($this->ajaxURL)) {
            $this->ajaxURL($ajaxUrl);
        }

        return $this->toArray();
    }

    /**
     * Make a new column instance.
     *
     * @param  array  $options
     * @return static
     */
    public static function make(array $options = []): static
    {
        return new static($options);
    }

    /**
     * Sets the height of the containing element, can be set to any valid height css value.
     * If set to false (the default), the height of the table will resize to fit the table data.
     *
     * @param	string|int	$height
     * @return	$this
     */
    public function height(string|int $height): self
    {
        $this->attributes['height'] = $height;

        return $this;
    }

    /**
     * Sets the minimum height for the table, can be set to any valid height css value.
     *
     * @param	string|int	$minHeight
     * @return	$this
     */
    public function minHeight(string|int $minHeight): self
    {
        $this->attributes['minHeight'] = $minHeight;

        return $this;
    }

    /**
     * Sets the maximum height for the table, can be set to any valid height css value.
     *
     * @param	string|int	$maxHeight
     * @return	$this
     */
    public function maxHeight(string|int $maxHeight): self
    {
        $this->attributes['maxHeight'] = $maxHeight;

        return $this;
    }

    /**
     * Set the tables vertical renderer.
     *
     * @param	string	$renderVertical
     * @return	$this
     */
    public function renderVertical(string $renderVertical): self
    {
        $this->attributes['renderVertical'] = $renderVertical;

        return $this;
    }

    /**
     * Manually set the size of the vertical renderer buffer.
     *
     * @param	int	$renderVerticalBuffer
     * @return	$this
     */
    public function renderVerticalBuffer(int $renderVerticalBuffer): self
    {
        $this->attributes['renderVerticalBuffer'] = $renderVerticalBuffer;

        return $this;
    }

    /**
     * Set the tables horizontal renderer.
     *
     * @param	string	$renderHorizontal
     * @return	$this
     */
    public function renderHorizontal(string $renderHorizontal): self
    {
        $this->attributes['renderHorizontal'] = $renderHorizontal;

        return $this;
    }

    /**
     * placeholder element to display on empty table.
     *
     * @param	string	$placeholder
     * @return	$this
     */
    public function placeholder(string $placeholder): self
    {
        $this->attributes['placeholder'] = $placeholder;

        return $this;
    }

    /**
     * Footer element for the table.
     *
     * @param	string	$footerElement
     * @return	$this
     */
    public function footerElement(string $footerElement): self
    {
        $this->attributes['footerElement'] = $footerElement;

        return $this;
    }

    /**
     * Enable user interaction history functionality.
     *
     * @param	bool|string	$history
     * @return	$this
     */
    public function history(bool|string $history): self
    {
        $this->attributes['history'] = $history;

        return $this;
    }

    /**
     * Keybinding configuration object.
     *
     * @param	bool|string	$keybindings
     * @return	$this
     */
    public function keybindings(bool|string $keybindings): self
    {
        $this->attributes['keybindings'] = $keybindings;

        return $this;
    }

    /**
     * set the current localization language.
     *
     * @param	string|bool	$locale
     * @return	$this
     */
    public function locale(string|bool $locale): self
    {
        $this->attributes['locale'] = $locale;

        return $this;
    }

    /**
     * hold localization templates.
     *
     * @param	array	$langs
     * @return	$this
     */
    public function langs(array $langs): self
    {
        $this->attributes['langs'] = $langs;

        return $this;
    }

    /**
     * choose which parts of the table are included in downloaded files.
     *
     * @param	object	$downloadConfig
     * @return	$this
     */
    public function downloadConfig(object $downloadConfig): self
    {
        $this->attributes['downloadConfig'] = $downloadConfig;

        return $this;
    }

    /**
     * set the range of rows to be included in the downloaded table output.
     *
     * @param	string	$downloadRowRange
     * @return	$this
     */
    public function downloadRowRange(string $downloadRowRange): self
    {
        $this->attributes['downloadRowRange'] = $downloadRowRange;

        return $this;
    }

    /**
     * choose which parts of the table are included in getHtml function output.
     *
     * @param	object	$htmlOutputConfig
     * @return	$this
     */
    public function htmlOutputConfig(object $htmlOutputConfig): self
    {
        $this->attributes['htmlOutputConfig'] = $htmlOutputConfig;

        return $this;
    }

    /**
     * enable data reactivity.
     *
     * @param	bool	$reactiveData
     * @return	$this
     */
    public function reactiveData(bool $reactiveData): self
    {
        $this->attributes['reactiveData'] = $reactiveData;

        return $this;
    }

    /**
     * add new row when user tabs of the end of the table.
     *
     * @param	bool|array|string	$tabEndNewRow
     * @return	$this
     */
    public function tabEndNewRow(bool|array|string $tabEndNewRow): self
    {
        $this->attributes['tabEndNewRow'] = $tabEndNewRow;

        return $this;
    }

    /**
     * set validation mode of the table.
     *
     * @param	string	$validationMode
     * @return	$this
     */
    public function validationMode(string $validationMode): self
    {
        $this->attributes['validationMode'] = $validationMode;

        return $this;
    }

    /**
     * set text direction for the table.
     *
     * @param	string	$textDirection
     * @return	$this
     */
    public function textDirection(string $textDirection): self
    {
        $this->attributes['textDirection'] = $textDirection;

        return $this;
    }

    /**
     * show console warnings if invalid options are used.
     *
     * @param	bool	$debugInvalidOptions
     * @return	$this
     */
    public function debugInvalidOptions(bool $debugInvalidOptions): self
    {
        $this->attributes['debugInvalidOptions'] = $debugInvalidOptions;

        return $this;
    }

    /**
     * containing element for popups.
     *
     * @param	bool|string	$popupContainer
     * @return	$this
     */
    public function popupContainer(bool|string $popupContainer): self
    {
        $this->attributes['popupContainer'] = $popupContainer;

        return $this;
    }

    /**
     * Provide a console warning if you are trying to call a function on a component that does not exist.
     *
     * Enabled by default. With the new optional modular structure this is particularly valuable as it will prompt
     * you if you are trying to use a function on a component for a module that has not been installed.
     *
     * @param  bool  $debugInvalidComponentFuncs
     * @return $this
     */
    public function debugInvalidComponentFuncs(bool $debugInvalidComponentFuncs = true): self
    {
        $this->attributes['debugInvalidComponentFuncs'] = $debugInvalidComponentFuncs;

        return $this;
    }

    /**
     * Provide a console warning if you attempt to use a setup option that has been deprecated.
     *
     * Enabled by default.
     *
     * @param  bool  $debugDeprecation
     * @return $this
     */
    public function debugDeprecation(bool $debugDeprecation = true): self
    {
        $this->attributes['debugDeprecation'] = $debugDeprecation;

        return $this;
    }

    /**
     * Freeze rows to the top of the table.
     *
     * @param  int|string|array  $frozenRows
     * @return $this
     */
    public function frozenRows(int|string|array $frozenRows): self
    {
        $this->attributes['frozenRows'] = $frozenRows;

        return $this;
    }

    /**
     * Freeze rows based on the value of a field.
     *
     * @param  string  $frozenRowsField
     * @return $this
     */
    public function frozenRowsField(string $frozenRowsField): self
    {
        $this->attributes['frozenRowsField'] = $frozenRowsField;

        return $this;
    }

    /**
     * Handle dynamic method calls into the method.
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
}
