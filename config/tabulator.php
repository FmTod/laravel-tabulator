<?php

return [
    /**
     * The name of the variable that will be used to send the tabulator options to the frontend.
     */
    'variable' => 'tabulator',

    /**
     * Namespace where the new table class will be created (relative to the root namespace).
     */
    'namespace' => 'Tabulator',

    /**
     * Namespace where the models are located (relative to the root namespace).
     */
    'models' => 'Models',

    /**
     * The default renderer to use.
     */
    'renderer' => FmTod\LaravelTabulator\Renderer\BladeRenderer::class,


    'sort' => [
        /**
         * Default sorter to use.
         */
        'sorter' => FmTod\LaravelTabulator\Sorters\DefaultSorter::class,

        /**
         * Custom sort class to use when sorting by a relation's column/field.
         */
        'relations' => [
            Illuminate\Database\Eloquent\Relations\BelongsTo::class => FmTod\LaravelTabulator\Sorters\Relations\SortByBelongsTo::class,
            Illuminate\Database\Eloquent\Relations\HasMany::class => FmTod\LaravelTabulator\Sorters\Relations\SortByHasMany::class,
            Illuminate\Database\Eloquent\Relations\BelongsToMany::class => FmTod\LaravelTabulator\Sorters\Relations\SortByBelongsToMany::class,
        ],
    ],
];
