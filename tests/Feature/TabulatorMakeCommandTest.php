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
    artisan('make:tabulator User');

    // Assert a new file is created
    expect(File::exists($tableClass))->toBeTrue();

    // Assert the file contains the right contents
    $expectedContents = <<<CLASS
    <?php

    namespace App\Tabulator;

    use App\Models\User;
    use FmTod\LaravelTabulator\Concerns\HasFilters;
    use FmTod\LaravelTabulator\Concerns\HasSorts;
    use FmTod\LaravelTabulator\Facades\Tabulator;
    use FmTod\LaravelTabulator\Helpers\Column;
    use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
    use FmTod\LaravelTabulator\TabulatorTable;
    use Illuminate\Database\Eloquent\Builder;

    class UserTable extends TabulatorTable
    {
        use HasFilters;
        use HasSorts;

        public function config(): TabulatorConfig
        {
            return Tabulator::config();
        }

        public function query(): Builder
        {
            return User::query();
        }

        public function columns(): array
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

    // Normalize the contents by removing line endings
    $actualContents = str_replace('\r\n', '\n', file_get_contents($tableClass));

    expect($actualContents)->toEqual($expectedContents);
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
    artisan('make:tabulator App/Tabulator/UserTable --columns=user,first,last,middle,email');

    // Assert a new file is created
    expect(File::exists($tableClass))->toBeTrue();

    // Assert the file contains the right contents
    $expectedContents = <<<CLASS
    <?php

    namespace App\Tabulator;

    use App\Models\User;
    use FmTod\LaravelTabulator\Concerns\HasFilters;
    use FmTod\LaravelTabulator\Concerns\HasSorts;
    use FmTod\LaravelTabulator\Facades\Tabulator;
    use FmTod\LaravelTabulator\Helpers\Column;
    use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
    use FmTod\LaravelTabulator\TabulatorTable;
    use Illuminate\Database\Eloquent\Builder;

    class UserTable extends TabulatorTable
    {
        use HasFilters;
        use HasSorts;

        public function config(): TabulatorConfig
        {
            return Tabulator::config();
        }

        public function query(): Builder
        {
            return User::query();
        }

        public function columns(): array
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

    // Normalize the contents by removing line endings
    $actualContents = str_replace('\r\n', '\n', file_get_contents($tableClass));

    expect($actualContents)->toEqual($expectedContents);
});

it('can create table class with model name', function () {
    // destination path of the Foo class
    $tableClass = app_path('Tabulator/Test/UserTable.php');

    // make sure we're starting from a clean state
    if (File::exists($tableClass)) {
        unlink($tableClass);
    }

    expect(File::exists($tableClass))->toBeFalse();

    // Run the make command
    artisan('make:tabulator Test/UserTable --model=OtherUser');

    // Assert a new file is created
    expect(File::exists($tableClass))->toBeTrue();

    // Assert the file contains the right contents
    $expectedContents = <<<CLASS
    <?php

    namespace App\Tabulator\Test;

    use FmTod\LaravelTabulator\Concerns\HasFilters;
    use FmTod\LaravelTabulator\Concerns\HasSorts;
    use FmTod\LaravelTabulator\Facades\Tabulator;
    use FmTod\LaravelTabulator\Helpers\Column;
    use FmTod\LaravelTabulator\Helpers\TabulatorConfig;
    use FmTod\LaravelTabulator\TabulatorTable;
    use Illuminate\Database\Eloquent\Builder;
    use OtherUser;

    class UserTable extends TabulatorTable
    {
        use HasFilters;
        use HasSorts;

        public function config(): TabulatorConfig
        {
            return Tabulator::config();
        }

        public function query(): Builder
        {
            return OtherUser::query();
        }

        public function columns(): array
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

    // Normalize the contents by removing line endings
    $actualContents = str_replace('\r\n', '\n', file_get_contents($tableClass));

    expect($actualContents)->toEqual($expectedContents);
});
