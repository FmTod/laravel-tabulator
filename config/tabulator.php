<?php

return [
    /**
     * The default renderer to use.
     */
    'renderer' => FmTod\LaravelTabulator\Renderer\BladeRenderer::class,

    /**
     * The name of the variable that will be used to send the tabulator options to the frontend.
     */
    'variable' => 'tabulator',


    'namespaces' => [
        /**
         * The namespace where the tabulator tables will be placed.
         */
        'table' => 'Tabulator',

        /**
         * The namespace where the models are located without the root namespace.
         */
        'model' => 'Models',
    ],
];
