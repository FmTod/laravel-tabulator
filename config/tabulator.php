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

    /**
     * Sort configuration.
     */
    'sort' => [
        /**
         * Default sorter to use.
         */
        'sorter' => FmTod\LaravelTabulator\Sorters\DefaultSorter::class,

        /**
         * Whether to include the table name in the sort field for the main table columns.
         */
        'include_table_name' => false,

        /**
         * Custom sort classes to use when sorting by a relation's column/field.
         */
        'relations' => [
            Illuminate\Database\Eloquent\Relations\BelongsTo::class => FmTod\LaravelTabulator\Sorters\Relations\SortByBelongsTo::class,
            Illuminate\Database\Eloquent\Relations\HasMany::class => FmTod\LaravelTabulator\Sorters\Relations\SortByHasManyLatest::class,
            Illuminate\Database\Eloquent\Relations\BelongsToMany::class => FmTod\LaravelTabulator\Sorters\Relations\SortByBelongsToMany::class,
        ],

        /**
         * Custom sort classes to use when sorting by a tree view child.
         *
         * Note: If null, it will use the same classes as the relation sorts.
         */
        'tree' => null,
    ],

    /**
     * Filter configuration.
     */
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

    /**
     * Actions column configuration.
     */
    'action' => [
        'field' => 'actions',
        'title' => 'Actions',
        'hozAlign' => 'left',
        'headerSort' => false,
    ],

    /**
     * Persistence configuration.
     */
    'persistence' => [
        /**
         * Enable/disable persistence.
         */
        'enabled' => true,

        /**
         * Persistence storage driver.
         */
        'driver' => FmTod\LaravelTabulator\Persistence\DatabaseStorage::class,

        /**
         * Database persistence storage driver options.
         */
        'database' => [
            /**
             * Model to use for the persistence storage.
             */
            'model' => FmTod\LaravelTabulator\Models\TabulatorPersistence::class,

            /**
             * Table name to use for the persistence storage.
             */
            'table' => 'tabulator_persistence',

            /**
             * Connection name to use for the persistence storage. If null, the default connection will be used.
             */
            'connection' => null,

            /**
             * Save the persistence data per user.
             */
            'per_user' => false,
        ]
    ],

    /**
     * Defaults
     */
    'defaults' => [
        /**
         * Default properties to use when creating a new column.
         */
        'column' => [],

        /**
         * Default config to use when creating a new action.
         */
        'action' => [],

        /**
         * Default config to use when creating a new table.
         */
        'config' => [],
    ]
];
