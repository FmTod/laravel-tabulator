<?php

namespace FmTod\LaravelTabulator\Tests\stubs\Controllers;

use FmTod\LaravelTabulator\Tests\stubs\UserTable;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function index(): mixed
    {
        return UserTable::view('welcome', ['extra' => 'extra']);
    }
}
