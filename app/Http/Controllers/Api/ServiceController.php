<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    // GET all services
    public function index(): JsonResponse
    {
        $services = Service::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Services retrieved successfully',
            'data' => $services
        ]);
    }

    // CREATE service
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
        ]);

        $service = Service::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Service created successfully',
            'data' => $service
        ], 201);
    }

    // GET service by id
    public function show($id): JsonResponse
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $service
        ]);
    }

    // UPDATE service
    public function update(Request $request, $id): JsonResponse
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found'
            ], 404);
        }

        $data = $request->validate([
            'name' => ['sometimes', 'string'],
            'price' => ['sometimes', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
        ]);

        $service->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Service updated successfully',
            'data' => $service
        ]);
    }

    // DELETE service
    public function destroy($id): JsonResponse
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found'
            ], 404);
        }

        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully'
        ]);
    }
}