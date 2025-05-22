<?php

namespace App\Services;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

abstract class CrudService
{
    protected $repository;

    public function index(): JsonResponse
    {
        $row = $this->repository->paginated();

        return response()->json([
            'message' => 'Успешно.',
            'data'    => [
                'items'       => $row->items(),
                'hasNext'     => $row->hasMorePages(),
                'currentPage' => $row->currentPage(),
                'lastPage'    => $row->lastPage(),
            ],
        ]);
    }

    public function store(array $data): JsonResponse
    {
        try {
            return response()->json(['message' => 'Успешно.', 'data' => $this->repository->create($data)], 201);
        } catch (Exception $e) {
            // Обработка исключения
            Log::error('Произошла ошибка ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function show($item): JsonResponse
    {
        return response()->json(['message' => 'Успешно.', 'data' => $item]);
    }

    public function edit($item): JsonResponse
    {
        return response()->json(['message' => 'Успешно.', 'data' => $item]);
    }

    public function update($item, array $data): JsonResponse
    {
        try {
            return response()->json(['message' => 'Успешно.', 'data' => $this->repository->update($item, $data)]);
        } catch (Exception $e) {
            // Обработка исключения
            Log::error('Произошла ошибка ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function destroy($item): JsonResponse
    {
        return response()->json(['message' => 'Успешно.', 'data' => $this->repository->destroy($item)]);
    }
}
