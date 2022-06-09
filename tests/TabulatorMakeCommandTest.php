<?php

use Illuminate\Support\Facades\File;
use function Pest\Laravel\artisan;

it('can create basic table class', function () {
    // destination path of the Foo class
    $tableClass = app_path('Tabulator/UserTable.php');

    // make sure we're starting from a clean state
    if (File::exists($tableClass)) {
        unlink($tableClass);
    }

    expect(File::exists($tableClass))->toBeFalse();

    // Run the make command
    artisan('make:tabulator UserTable');

    // Assert a new file is created
    expect(File::exists($tableClass))->toBeTrue();

    // Assert the file contains the right contents
    $expectedContents = <<<CLASS
    <?php

    namespace App\Tabulator;
    
    use App\User;
    use FmTod\LaravelTabulator\Helpers\Column;
    use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
    use FmTod\LaravelTabulator\TabulatorTable;
    
    class UserTable extends TabulatorTable
    {
        protected function config(): TabulatorConfig
        {
            return TabulatorConfig::make();
        }
    
        protected function query(): Builder
        {
            return User::query();
        }
    
        protected function columns(): array
        {
            return [
                Column::make('id'),
                Column::make('add your columns'),
                Column::make('created_at'),
                Column::make('updated_at'),
            ];
        }
    }
    CLASS;

    expect(file_get_contents($tableClass))->toEqual($expectedContents);
});

it('can create table class with columns', function () {
    // destination path of the Foo class
    $tableClass = app_path('Tabulator/UserTable.php');

    // make sure we're starting from a clean state
    if (File::exists($tableClass)) {
        unlink($tableClass);
    }

    expect(File::exists($tableClass))->toBeFalse();

    // Run the make command
    artisan('make:tabulator UserTable --columns=user,first,last,middle,email');

    // Assert a new file is created
    expect(File::exists($tableClass))->toBeTrue();

    // Assert the file contains the right contents
    $expectedContents = <<<CLASS
    <?php

    namespace App\Tabulator;
    
    use App\User;
    use FmTod\LaravelTabulator\Helpers\Column;
    use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
    use FmTod\LaravelTabulator\TabulatorTable;
    
    class UserTable extends TabulatorTable
    {
        protected function config(): TabulatorConfig
        {
            return TabulatorConfig::make();
        }
    
        protected function query(): Builder
        {
            return User::query();
        }
    
        protected function columns(): array
        {
            return [
                Column::make('user'),
                Column::make('first'),
                Column::make('last'),
                Column::make('middle'),
                Column::make('email'),
            ];
        }
    }
    CLASS;

    expect(file_get_contents($tableClass))->toEqual($expectedContents);
});

it('can create table class with model name', function () {
    // destination path of the Foo class
    $tableClass = app_path('Tabulator/UserTable.php');

    // make sure we're starting from a clean state
    if (File::exists($tableClass)) {
        unlink($tableClass);
    }

    expect(File::exists($tableClass))->toBeFalse();

    // Run the make command
    artisan('make:tabulator UserTable --model=OtherUser');

    // Assert a new file is created
    expect(File::exists($tableClass))->toBeTrue();

    // Assert the file contains the right contents
    $expectedContents = <<<CLASS
    <?php

    namespace App\Tabulator;
    
    use FmTod\LaravelTabulator\Helpers\Column;
    use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
    use FmTod\LaravelTabulator\TabulatorTable;
    use OtherUser;
    
    class UserTable extends TabulatorTable
    {
        protected function config(): TabulatorConfig
        {
            return TabulatorConfig::make();
        }
    
        protected function query(): Builder
        {
            return OtherUser::query();
        }
    
        protected function columns(): array
        {
            return [
                Column::make('id'),
                Column::make('add your columns'),
                Column::make('created_at'),
                Column::make('updated_at'),
            ];
        }
    }
    CLASS;

    expect(file_get_contents($tableClass))->toEqual($expectedContents);
});
