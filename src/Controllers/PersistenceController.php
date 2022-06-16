<?php

namespace FmTod\LaravelTabulator\Controllers;

use FmTod\LaravelTabulator\Facades\Tabulator;
use FmTod\LaravelTabulator\Models\TabulatorPersistence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PersistenceController extends Controller
{
    protected string $model;

    public function __construct()
    {
        $this->model = config('tabulator.persistence.model', TabulatorPersistence::class);
    }

    public function index(string $table): JsonResponse
    {
        $table = Tabulator::persistenceTable($table);

        return response()->json($table);
    }

    public function store(Request $request, string $table, string $type): JsonResponse
    {
        $data = $request->validate(['data' => 'required|json']);

        $model = Tabulator::persistenceSave($table, $type, $data['data']);

        return response()->json($model);
    }

    public function show(string $table, string $type): JsonResponse
    {
        $model = Tabulator::persistenceGet($table, $type);

        if (!$model) {
            return response()->json(['message' => "Could not find persistence data for '$type' from the '$table' table."], 404);
        }

        return response()->json($model);
    }
}
