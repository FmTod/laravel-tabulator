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


    'filter' => [
        'filterer' => FmTod\LaravelTabulator\Filterers\DefaultFilterer::class,

        'types' => [
            FmTod\LaravelTabulator\Filterers\Filters\ComparisonFilter::class => ['=', '!=', '<', '<=', '>', '>='],
            FmTod\LaravelTabulator\Filterers\Filters\LikeFilter::class => 'like',
            FmTod\LaravelTabulator\Filterers\Filters\StartsFilter::class => 'starts',
            FmTod\LaravelTabulator\Filterers\Filters\EndsFilter::class => 'ends',
            FmTod\LaravelTabulator\Filterers\Filters\InFilter::class => 'in',
            FmTod\LaravelTabulator\Filterers\Filters\KeywordsFilter::class => 'keywords',
            FmTod\LaravelTabulator\Filterers\Filters\MinMaxFilter::class => 'minMax',
            FmTod\LaravelTabulator\Filterers\Filters\TextSearchFilter::class => 'textSearch',
        ]
    ],

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
