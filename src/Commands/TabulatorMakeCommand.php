<?php

namespace FmTod\LaravelTabulator\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TabulatorMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:tabulator
                            {name : The name of the DataTable.}
                            {--model= : The name of the model to be used.}
                            {--model-namespace= : The namespace of the model to be used.}
                            {--table= : Scaffold columns from the table.}
                            {--columns= : The columns of the table.}
                            {--force= : Force create the table.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Tabulator table service class.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'TabulatorTable';

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name): string
    {
        $stub = parent::buildClass($name);

        $this->replaceModelImport($stub)
            ->replaceModel($stub)
            ->replaceColumns($stub);

        return $stub;
    }

    /**
     * Replace columns.
     *
     * @return $this
     */
    protected function replaceColumns(string &$stub): static
    {
        $stub = str_replace('{{ columns }}', $this->getColumns(), $stub);

        return $this;
    }

    /**
     * Get the columns to be used.
     */
    protected function getColumns(): string
    {
        if ($this->option('columns')) {
            return $this->parseColumns($this->option('columns'));
        }

        if (class_exists($model = $this->getModel())) {
            /** @var \Illuminate\Database\Eloquent\Model $newInstance */
            $newModelInstance = new $model();
            $columns = Schema::connection($newModelInstance->getConnectionName())
                ->getColumnListing($newModelInstance->getTable());

            return $this->parseColumns($columns);
        }

        return $this->parseColumns(
            $this->laravel['config']->get(
                'datatables-buttons.generator.columns',
                'id,add your columns,created_at,updated_at'
            )
        );
    }

    /**
     * Parse array from definition.
     */
    protected function parseColumns(string|array $definition, int $indentation = 12): string
    {
        $columns = is_array($definition) ? $definition : explode(',', $definition);
        $stub = '';
        foreach ($columns as $key => $column) {
            $stub .= "Column::make('$column'),";

            if ($key < count($columns) - 1) {
                $stub .= PHP_EOL.str_repeat(' ', $indentation);
            }
        }

        return $stub;
    }

    /**
     * Parse the name and format according to the root namespace.
     *
     * @param  string  $name
     */
    protected function qualifyClass($name): string
    {
        $rootNamespace = app()->getNamespace();

        if (Str::contains($name, '/')) {
            $name = str_replace('/', '\\', $name);
        }

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        if (! Str::contains($name, 'table', true)) {
            $name .= 'Table';
        }

        return $this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\\'.config('tabulator.namespace', 'Tabulator');
    }

    /**
     * Replace model name.
     *
     * @return \FmTod\LaravelTabulator\Commands\TabulatorMakeCommand
     */
    protected function replaceModel(string &$stub): static
    {
        $model = explode('\\', $this->getModel());
        $model = array_pop($model);
        $stub = str_replace('{{ model }}', $model, $stub);

        return $this;
    }

    /**
     * Get model name to use.
     */
    protected function getModel(): ?string
    {
        $name = $this->getNameInput();
        $rootNamespace = $this->laravel->getNamespace();
        $model = $this->option('model') === '' || $this->option('model-namespace');
        $modelNamespace = $this->option('model-namespace') ?: config('tabulator.models');

        if ($this->option('model')) {
            return $this->option('model');
        }

        // check if model namespace is not set in command and Models directory already exists then use that directory in namespace.
        if (! $modelNamespace) {
            $modelNamespace = is_dir(app_path('Models')) ? 'Models' : $rootNamespace;
        }

        return $model
            ? $rootNamespace.'\\'.($modelNamespace ? $modelNamespace.'\\' : '').Str::singular($name)
            : $rootNamespace.'\\'.($modelNamespace ? $modelNamespace.'\\' : '').'User';
    }

    /**
     * Replace model import.
     *
     * @return $this
     */
    protected function replaceModelImport(string &$stub): static
    {
        $stub = str_replace('{{ namespacedModel }}', str_replace('\\\\', '\\', $this->getModel()), $stub);

        return $this;
    }

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/tabulator.table.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     */
    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : dirname(__DIR__, 2).$stub;
    }
}
