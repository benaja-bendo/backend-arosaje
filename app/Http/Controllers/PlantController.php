<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PlantResource;
use App\Http\Resources\PlantResourceCollection;

class PlantController extends ApiController
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $plants = Plant::all();

        return $this->successResponse(
            data: new PlantResourceCollection($plants),
            message: 'Plants retrieved successfully.'
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',  // Added validation for 'address'
            'path_image' => 'required|file|max:1024|mimes:jpeg,jpg,png',  // Ensure valid image types
            'user_created' => 'required',
            'date_begin' => 'nullable | date',
            'date_end' => 'nullable | date',
            'is_published' => 'nullable | boolean',
        ]);

        $path_image = null;
        if ($request->hasFile('path_image')) {
            $path_image = $request->file('path_image')->store('plants');
        }

        $plant = Plant::create([
            'name' => $request->name,
            'description' => $request->description,
            'path_image' => $path_image,
            'address' => $request->address,
            'user_created' => $request->user_created,
            'date_begin' => $request->date_begin,
            'date_end' => $request->date_end,
            'is_published' => $request->is_published ?? false,
        ]);

        return $this->successResponse(
            data: new PlantResource($plant),
            message: 'Plant created successfully.'
        );
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $plant = Plant::find($id);

        if (is_null($plant)) {
            return $this->errorResponse(
                error: 'Plant not found . '
            );
        }

        return $this->successResponse(
            data: new PlantResource($plant),
            message: 'Plant retrieved successfully . '
        );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $plant = Plant::find($id);
        if (is_null($plant)) {
            return $this->errorResponse(
                error: 'Plant not found . '
            );
        }

        $request->validate(
            rules: [
                'name' => 'nullable | string | max:255',
                'description' => 'nullable | string | max:255',
                'path_image' => 'nullable | string | max:255',
                'user_created' => 'nullable | string | max:255',
                'date_begin' => 'nullable | date',
                'date_end' => 'nullable | date',
                'is_published' => 'nullable | boolean',
            ]
        );

        $plant->update($request->all());

        return $this->successResponse(
            data: new PlantResource($plant),
            message: 'Plant updated successfully . '
        );
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $plant = Plant::find($id);

        if (is_null($plant)) {
            return $this->errorResponse(
                error: 'Plant not found . '
            );
        }

        $plant->delete();

        return $this->successResponse(
            data: [],
            message: 'Plant deleted successfully . '
        );
    }

    public function getMyPlants(string $id): JsonResponse
    {
        $plants = Plant::where('user_created', $id)->get();

        if ($plants->isEmpty()) {
            return $this->errorResponse(
                error: 'My plants not found . '
            );
        }

        return $this->successResponse(
            data: new PlantResourceCollection($plants),
            message: 'My plants retrieved successfully . '
        );
    }
}
