<?php

namespace FmTod\LaravelTabulator\Contracts;

use FmTod\LaravelTabulator\Helpers\TabulatorConfig;

interface TabulatorModel
{
    public static function tabulatorColumns(): TabulatorConfig;
}
