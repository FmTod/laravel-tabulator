<?php

namespace FmTod\LaravelTabulator\Concerns\Config;

/**
 * @codeCoverageIgnore
 */
trait ClipboardConfig
{
    /**
     * Enable clipboard module.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ClipboardConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function clipboard(bool $clipboard): self
    {
        $this->attributes['clipboard'] = $clipboard;

        return $this;
    }

    /**
     * Set which rows are visible in clipboard output.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ClipboardConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function clipboardCopyRowRange(string $clipboardCopyRowRange): self
    {
        $this->attributes['clipboardCopyRowRange'] = $clipboardCopyRowRange;

        return $this;
    }

    /**
     * Format clipboard output before it is inserted in the clipboard.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ClipboardConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function clipboardCopyFormatter(string $clipboardCopyFormatter): self
    {
        $this->attributes['clipboardCopyFormatter'] = $clipboardCopyFormatter;

        return $this;
    }

    /**
     * Clipboard paste parser function.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ClipboardConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function clipboardPasteParser(string $clipboardPasteParser): self
    {
        $this->attributes['clipboardPasteParser'] = $clipboardPasteParser;

        return $this;
    }

    /**
     * Clipboard paste action function.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\ClipboardConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function clipboardPasteAction(string $clipboardPasteAction): self
    {
        $this->attributes['clipboardPasteAction'] = $clipboardPasteAction;

        return $this;
    }
}
