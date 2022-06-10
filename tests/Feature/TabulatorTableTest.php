<?php

use FmTod\LaravelTabulator\Tests\stubs\Models\User;
use FmTod\LaravelTabulator\Tests\stubs\UserTable;
use Illuminate\Support\Facades\Route;
use function Pest\Laravel\postJson;

beforeEach(function () {
    $migration = include dirname(__DIR__) . '/stubs/Migrations/create_users_table.php';
    $migration->up();

    $this->users = User::factory()->count(10)->create();

    Route::match(['GET', 'POST'], 'users', fn () => UserTable::view('welcome', ['extra' => 'extra']))->name('users.index');
});

it('returns html on browser request')
    ->get('/users')
    ->assertSuccessful()
    ->assertViewHas('extra')
    ->assertViewIs('welcome')
    ->assertSeeText('Laravel');

it('returns json on ajax request')
    ->getJson('/users')
    ->assertSuccessful()
    ->assertJsonStructure([
        'current_page',
        'total',
        'data',
    ])
    ->assertJsonCount(10, 'data');

it('can identify page from the request')
    ->getJson('/users?page=2')
    ->assertSuccessful()
    ->assertJsonPath('current_page', 2);

it('builds the options object to send to the frontend', function () {
    $table = new UserTable();

    expect($table->options())->toHaveKeys([
        'layout',
        'pagination',
        'paginationMode',
        'paginationSize',
        'placeholder',
        'filterMode',
        'ajaxURL',
        'columns',
    ]);
});

it('renders the given view', function () {
    $table = new UserTable();

    /** @var \Illuminate\Http\Response $response */
    $response = $table->render('welcome');

    /** @var \Illuminate\View\View $view */
    $view = $response->original;

    expect($view)->getData()->toHaveKey(config('tabulator.variable'));
});

it('can apply query filters', function () {
    $user = User::first();
    $filters = [
        ['field' => 'first_name', 'type' => 'like', 'value' => $user->first_name],
    ];

    postJson('/users', ['filters' => $filters])->assertJsonPath('data', [$user->toArray()]);
});
