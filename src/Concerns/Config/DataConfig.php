<?php

namespace FmTod\LaravelTabulator\Concerns\Config;

trait DataConfig
{
    /**
     * The field to be used as the unique index for each row.
     *
     * @param  string  $index
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function index(string $index): self
    {
        $this->attributes['index'] = $index;

        return $this;
    }

    /**
     * URL for remote Ajax data loading.
     *
     * @param  string|bool  $ajaxURL
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function ajaxURL(string|bool $ajaxURL): self
    {
        $this->attributes['ajaxURL'] = $ajaxURL;

        return $this;
    }

    /**
     * Parameters to be passed to remote Ajax data loading request.
     *
     * @param  array  $ajaxParams
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function ajaxParams(array $ajaxParams): self
    {
        $this->attributes['ajaxParams'] = $ajaxParams;

        return $this;
    }

    /**
     * The HTTP request type for Ajax requests or config object for the request.
     *
     * @param  string|array  $ajaxConfig
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function ajaxConfig(string|array $ajaxConfig): self
    {
        $this->attributes['ajaxConfig'] = $ajaxConfig;

        return $this;
    }

    /**
     * set the content encoding for the json request.
     *
     * @param  string|array  $ajaxContentType
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function ajaxContentType(string|array $ajaxContentType): self
    {
        $this->attributes['ajaxContentType'] = $ajaxContentType;

        return $this;
    }

    /**
     * callback function to generate request URL.
     *
     * @param  string  $ajaxURLGenerator
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function ajaxURLGenerator(string $ajaxURLGenerator): self
    {
        $this->attributes['ajaxURLGenerator'] = $ajaxURLGenerator;

        return $this;
    }

    /**
     * callback function to replace inbuilt ajax request functionality.
     *
     * @param  string  $ajaxRequestFunc
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function ajaxRequestFunc(string $ajaxRequestFunc): self
    {
        $this->attributes['ajaxRequestFunc'] = $ajaxRequestFunc;

        return $this;
    }

    /**
     * Lookup list to link expected data fields from the server to their function.
     *
     * @param  array  $dataSendParams
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataSendParams(array $dataSendParams): self
    {
        $this->attributes['dataSendParams'] = $dataSendParams;

        return $this;
    }

    /**
     * Send filter config to server instead of processing locally.
     *
     * @param	string	$filterMode
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function filterMode(string $filterMode): self
    {
        $this->attributes['filterMode'] = $filterMode;

        return $this;
    }

    /**
     * Send sorter config to server instead of processing locally.
     *
     * @param	string	$sortMode
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function sortMode(string $sortMode): self
    {
        $this->attributes['sortMode'] = $sortMode;

        return $this;
    }

    /**
     * Progressively load data into the table in chunks.
     *
     * @param	string|bool	$progressiveLoad
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function progressiveLoad(string|bool $progressiveLoad): self
    {
        $this->attributes['progressiveLoad'] = $progressiveLoad;

        return $this;
    }

    /**
     * Delay in milliseconds between each progressive load request.
     *
     * @param	int	$progressiveLoadDelay
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function progressiveLoadDelay(int $progressiveLoadDelay): self
    {
        $this->attributes['progressiveLoadDelay'] = $progressiveLoadDelay;

        return $this;
    }

    /**
     * The remaining distance in pixels between the scroll bar and the bottom of the table before an ajax is triggered.
     *
     * @param	int	$progressiveLoadScrollMargin
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function progressiveLoadScrollMargin(int $progressiveLoadScrollMargin): self
    {
        $this->attributes['progressiveLoadScrollMargin'] = $progressiveLoadScrollMargin;

        return $this;
    }

    /**
     * Show loader while data is loading, can also take a function that must return a bool.
     *
     * @param	bool|string	$dataLoader
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataLoader(bool|string $dataLoader): self
    {
        $this->attributes['dataLoader'] = $dataLoader;

        return $this;
    }

    /**
     * HTML for loader element.
     *
     * @param	string	$dataLoaderLoading
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataLoaderLoading(string $dataLoaderLoading): self
    {
        $this->attributes['dataLoaderLoading'] = $dataLoaderLoading;

        return $this;
    }

    /**
     * HTML for the loader element in the event of an error.
     *
     * @param	string	$dataLoaderError
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataLoaderError(string $dataLoaderError): self
    {
        $this->attributes['dataLoaderError'] = $dataLoaderError;

        return $this;
    }

    /**
     * The number of milliseconds to display the loader error message in the event of an error.
     *
     * @param	int	$dataLoaderErrorTimeout
     * @return \FmTod\LaravelTabulator\Concerns\Config\DataConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function dataLoaderErrorTimeout(int $dataLoaderErrorTimeout): self
    {
        $this->attributes['dataLoaderErrorTimeout'] = $dataLoaderErrorTimeout;

        return $this;
    }
}