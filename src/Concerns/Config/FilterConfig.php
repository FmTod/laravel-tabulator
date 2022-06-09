<?php

namespace FmTod\LaravelTabulator\Concerns\Config;

/**
 * @codeCoverageIgnore
 */
trait FilterConfig
{
    /**
     * Array of filters to be applied on load.
     *
     * @param  array  $initialFilter
     * @return \FmTod\LaravelTabulator\Helpers\TabulatorConfig|\FmTod\LaravelTabulator\Concerns\Config\FilterConfig
     */
    public function initialFilter(array $initialFilter): self
    {
        $this->attributes['initialFilter'] = $initialFilter;

        return $this;
    }

    /**
     * Array of initial values for header filters.
     *
     * @param  array  $initialHeaderFilter
     * @return \FmTod\LaravelTabulator\Helpers\TabulatorConfig|\FmTod\LaravelTabulator\Concerns\Config\FilterConfig
     */
    public function initialHeaderFilter(array $initialHeaderFilter): self
    {
        $this->attributes['initialHeaderFilter'] = $initialHeaderFilter;

        return $this;
    }

    /**
     * Number of milliseconds to wait after a keystroke before triggering a header filter.
     *
     * @param  int  $headerFilterLiveFilterDelay
     * @return \FmTod\LaravelTabulator\Helpers\TabulatorConfig|\FmTod\LaravelTabulator\Concerns\Config\FilterConfig
     */
    public function headerFilterLiveFilterDelay(int $headerFilterLiveFilterDelay): self
    {
        $this->attributes['headerFilterLiveFilterDelay'] = $headerFilterLiveFilterDelay;

        return $this;
    }
}
