<?php

namespace FmTod\LaravelTabulator;

use FmTod\LaravelTabulator\Helpers\TabulatorConfig;

class Tabulator
{
    public function config(array $options = []): TabulatorConfig
    {
        return TabulatorConfig::make($options);
    }
}
