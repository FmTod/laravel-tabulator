<?php

namespace FmTod\LaravelTabulator\Controllers;

use FmTod\LaravelTabulator\Facades\Tabulator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class PersistenceController extends Controller
{
    public function show(string $table): JsonResponse
    {
        $data = Tabulator::persistenceTable($table);

        return response()->json($data);
    }

    public function store(Request $request, string $table): JsonResponse
    {
        $data = $request->validate([
            'columns' => 'sometimes|nullable|array',
            'sort' => 'sometimes|nullable|array',
            'page' => 'sometimes|nullable|array',
            'filter' => 'sometimes|nullable|array',
            'group' => 'sometimes|nullable|array',
        ]);

        $model = Tabulator::persistenceStore($table, $data);

        return response()->json($model);
    }

    public function destroy(string $table): Response
    {
        Tabulator::persistenceClear($table);

        return response()->noContent();
    }
}
