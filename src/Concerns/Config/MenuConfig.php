<?php

namespace FmTod\LaravelTabulator\Concerns\Config;

/**
 * @codeCoverageIgnore
 */
trait MenuConfig
{
    /**
     * Add context menu to rows.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\MenuConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function rowContextMenu(array $rowContextMenu): self
    {
        $this->attributes['rowContextMenu'] = $rowContextMenu;

        return $this;
    }

    /**
     * Add left click menu to rows.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\MenuConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function rowClickMenu(array $rowClickMenu): self
    {
        $this->attributes['rowClickMenu'] = $rowClickMenu;

        return $this;
    }

    /**
     * Add context menu to group headers.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\MenuConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function groupContextMenu(array $groupContextMenu): self
    {
        $this->attributes['groupContextMenu'] = $groupContextMenu;

        return $this;
    }

    /**
     * Add left click menu to group headers.
     *
     * @return \FmTod\LaravelTabulator\Concerns\Config\MenuConfig|\FmTod\LaravelTabulator\Helpers\TabulatorConfig
     */
    public function groupClickMenu(array $groupClickMenu): self
    {
        $this->attributes['groupClickMenu'] = $groupClickMenu;

        return $this;
    }
}
