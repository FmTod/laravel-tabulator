<?php

namespace FmTod\LaravelTabulator\Concerns;

use Illuminate\Contracts\Database\Query\Expression;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use ReflectionMethod;
use ReflectionNamedType;

trait SkipsUnbackedFields
{
    /**
     * Column names of the model's own table, resolved at most once per request.
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
     */
    protected function hasBackingColumn(Builder $query, string $field): bool
    {
        $model = $query->getModel();
        $builder = $query->getQuery();

        // Joined tables and raw select aliases expose columns the model's own schema
        // knows nothing about (MySQL resolves a select alias in `order by`), so such a
        // query cannot be vetted against the schema; only relations are rejected there.
        if (! empty($builder->joins) || $this->hasRawColumns($builder)) {
            return ! $this->isRelationBackedField($model, $field);
        }

        return in_array(Str::before($field, '->'), $this->columnListing($model), true);
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

    private function hasRawColumns(mixed $builder): bool
    {
        foreach ($builder->columns ?? [] as $column) {
            if ($column instanceof Expression) {
                return true;
            }
        }

        return false;
    }
}
