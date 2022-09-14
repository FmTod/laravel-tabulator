<?php

namespace FmTod\LaravelTabulator\Controllers;

use FmTod\LaravelTabulator\Facades\Tabulator;
use FmTod\LaravelTabulator\Models\TabulatorPersistence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class PersistenceTypeController extends Controller
{
    public function store(Request $request, string $table, string $type): JsonResponse
    {
        $data = $request->validate(['data' => 'sometimes|nullable|array']);

        $model = Tabulator::persistenceSave($table, $type, $data['data']);

        return response()->json($model);
    }

    public function show(string $table, string $type): JsonResponse
    {
        $model = Tabulator::persistenceGet($table, $type);

        if (! $model) {
            return response()->json([
                'message' => "Could not find persistence data for '$type' from the '$table' table.",
                'data' => null,
                'table' => $table,
                'type' => $type,
            ]);
        }

        return response()->json($model);
    }

    public function destroy(string $table, string $type): Response
    {
        Tabulator::persistenceDelete($table, $type);

        return response()->noContent();
    }
}
