<?php

namespace FmTod\LaravelTabulator\Concerns;

use Illuminate\Contracts\Database\Query\Expression;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use ReflectionMethod;
use ReflectionNamedType;

trait ResolvesBackingColumns
{
    /**
     * Column names per `connection.table`, resolved at most once per instance.
     *
     * The sorter and the filterer are resolved separately, so a request that both
     * sorts and filters warms two of these caches.
     *
     * @var array<string, array<int, string>>
     */
    private array $columnListings = [];

    /**
     * Whether a field can be emitted into an `order by` or `where` clause.
     *
     * Persisted table state keeps sending a field until the user clears it, so a
     * column rendered from something the database has no column for — an Eloquent
     * relation such as an `images` MorphToMany, an appended attribute, a column
     * since dropped — would fail the whole list request with an unknown column
     * error. A column that needs to be sortable or filterable without a matching
     * database column defines a `sortFunc`/`filterFunc`, which runs before this.
     *
     * A field ruled out here is dropped silently: the list loads unsorted or
     * unfiltered rather than erroring.
     */
    protected function hasBackingColumn(Builder $query, string $field): bool
    {
        $model = $query->getModel();

        // A real column always wins, even where a relation shares its name.
        if (in_array(Str::before($field, '->'), $this->columnListing($model), true)) {
            return true;
        }

        // Joins and raw select aliases expose columns the model's own schema knows
        // nothing about — `withCount()` alone adds one, and MySQL resolves a select
        // alias in `order by` — so such a query cannot be ruled out by the schema.
        // There, only a field naming a relation is rejected.
        $builder = $query->getQuery();

        if (! empty($builder->joins) || $this->hasRawColumns($builder)) {
            return ! $this->isRelationBackedField($model, $field);
        }

        return false;
    }

    /**
     * Whether a field is backed only by an Eloquent relation on the model.
     *
     * The method's declared return type is what decides this, so a same-named
     * accessor or config method (`casts()`, `condition()`) is not mistaken for one.
     */
    protected function isRelationBackedField(Model $model, string $field): bool
    {
        foreach ([$field, Str::camel($field)] as $method) {
            if (! method_exists($model, $method)) {
                continue;
            }

            $type = new ReflectionMethod($model, $method)->getReturnType();

            if ($type instanceof ReflectionNamedType && is_a($type->getName(), Relation::class, true)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array<int, string>
     */
    private function columnListing(Model $model): array
    {
        $connection = $model->getConnectionName();

        return $this->columnListings["$connection.{$model->getTable()}"]
            ??= Schema::connection($connection)->getColumnListing($model->getTable());
    }

    private function hasRawColumns(QueryBuilder $builder): bool
    {
        foreach ($builder->columns ?? [] as $column) {
            if ($column instanceof Expression) {
                return true;
            }
        }

        return false;
    }
}
