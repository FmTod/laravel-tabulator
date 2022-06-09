<?php

namespace FmTod\LaravelTabulator\Concerns\Config;

trait RowGroupConfig
{
    /**
     * String/function to select field to group rows by.
     *
     * @param  string|array  $groupBy
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowGroupConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function groupBy(string|array $groupBy): self
    {
        $this->attributes['groupBy'] = $groupBy;

        return $this;
    }

    /**
     * Array of values for groups.
     *
     * @param	array	$groupValues
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowGroupConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function groupValues(array $groupValues): self
    {
        $this->attributes['groupValues'] = $groupValues;

        return $this;
    }

    /**
     * function to layout group header row.
     *
     * @param	string|array	$groupHeader
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowGroupConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function groupHeader(string|array $groupHeader): self
    {
        $this->attributes['groupHeader'] = $groupHeader;

        return $this;
    }

    /**
     * Function to alter layout of group header rows when printed.
     *
     * @param	string|array	$groupHeaderPrint
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowGroupConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function groupHeaderPrint(string|array $groupHeaderPrint): self
    {
        $this->attributes['groupHeaderPrint'] = $groupHeaderPrint;

        return $this;
    }

    /**
     * Function to alter layout of group header rows when copied to the clipboard.
     *
     * @param	string|array	$groupHeaderClipboard
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowGroupConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function groupHeaderClipboard(string|array $groupHeaderClipboard): self
    {
        $this->attributes['groupHeaderClipboard'] = $groupHeaderClipboard;

        return $this;
    }

    /**
     * Function to alter layout of group header rows when downloaded.
     *
     * @param	string|array	$groupHeaderDownload
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowGroupConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function groupHeaderDownload(string|array $groupHeaderDownload): self
    {
        $this->attributes['groupHeaderDownload'] = $groupHeaderDownload;

        return $this;
    }

    /**
     * Function to alter layout of group header rows when the getHtml formatter is called.
     *
     * @param	string|array	$groupHeaderHtmlOutput
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowGroupConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function groupHeaderHtmlOutput(string|array $groupHeaderHtmlOutput): self
    {
        $this->attributes['groupHeaderHtmlOutput'] = $groupHeaderHtmlOutput;

        return $this;
    }

    /**
     * bool/function to set the open/closed state of groups when they are first created.
     *
     * @param	bool|string|array	$groupStartOpen
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowGroupConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function groupStartOpen(bool|string|array $groupStartOpen): self
    {
        $this->attributes['groupStartOpen'] = $groupStartOpen;

        return $this;
    }

    /**
     * Set which element triggers a group visibility toggle.
     *
     * @param	string|bool	$groupToggleElement
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowGroupConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function groupToggleElement(string|bool $groupToggleElement): self
    {
        $this->attributes['groupToggleElement'] = $groupToggleElement;

        return $this;
    }

    /**
     * show/hide column calculations when group is closed.
     *
     * @param	bool	$groupClosedShowCalcs
     * @return \FmTod\LaravelTabulator\Concerns\Config\RowGroupConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function groupClosedShowCalcs(bool $groupClosedShowCalcs): self
    {
        $this->attributes['groupClosedShowCalcs'] = $groupClosedShowCalcs;

        return $this;
    }
}