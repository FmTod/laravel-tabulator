<?php

namespace FmTod\LaravelTabulator\Concerns\Config;

trait PrintConfig
{
    /**
     * Enable HTML table printing.
     *
     * @param  bool  $printAsHtml
     * @return \FmTod\LaravelTabulator\Concerns\Config\PrintConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function printAsHtml(bool $printAsHtml): self
    {
        $this->attributes['printAsHtml'] = $printAsHtml;

        return $this;
    }

    /**
     * Copy table style to html print table.
     *
     * @param	bool	$printStyled
     * @return \FmTod\LaravelTabulator\Concerns\Config\PrintConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function printStyled(bool $printStyled): self
    {
        $this->attributes['printStyled'] = $printStyled;

        return $this;
    }

    /**
     * set the range of rows to be included in the printed table output.
     *
     * @param	string	$printRowRange
     * @return \FmTod\LaravelTabulator\Concerns\Config\PrintConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function printRowRange(string $printRowRange): self
    {
        $this->attributes['printRowRange'] = $printRowRange;

        return $this;
    }

    /**
     * Choose which parts of the table are included in print table.
     *
     * @param	object	$printConfig
     * @return \FmTod\LaravelTabulator\Concerns\Config\PrintConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function printConfig(object $printConfig): self
    {
        $this->attributes['printConfig'] = $printConfig;

        return $this;
    }

    /**
     * Add header to printed table.
     *
     * @param	bool|string	$printHeader
     * @return \FmTod\LaravelTabulator\Concerns\Config\PrintConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function printHeader(bool|string $printHeader): self
    {
        $this->attributes['printHeader'] = $printHeader;

        return $this;
    }

    /**
     * Add footer to printed table.
     *
     * @param	bool|string	$printFooter
     * @return \FmTod\LaravelTabulator\Concerns\Config\PrintConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function printFooter(bool|string $printFooter): self
    {
        $this->attributes['printFooter'] = $printFooter;

        return $this;
    }

    /**
     * Alter layout of print elements.
     *
     * @param	string|bool	$printFormatter
     * @return \FmTod\LaravelTabulator\Concerns\Config\PrintConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function printFormatter(string|bool $printFormatter): self
    {
        $this->attributes['printFormatter'] = $printFormatter;

        return $this;
    }
}
