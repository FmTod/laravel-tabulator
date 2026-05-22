<?php

use FmTod\LaravelTabulator\Helpers\TabulatorConfig;

it('throws for invalid attribute types', function () {
    TabulatorConfig::make('invalid');
})->throws(\InvalidArgumentException::class, 'TabulatorConfig::make expects attributes to be an array or Traversable, string given.');
