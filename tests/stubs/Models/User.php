<?php

namespace FmTod\LaravelTabulator\Tests\stubs\Models;

use FmTod\LaravelTabulator\Tests\stubs\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \FmTod\LaravelTabulator\Tests\stubs\Factories\UserFactory
     */
    protected static function newFactory(): UserFactory
    {
        return new UserFactory;
    }
}
