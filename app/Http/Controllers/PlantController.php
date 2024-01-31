<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlantResource;
use App\Models\Plant;
use Illuminate\Http\Request;
use App\Http\Resources\PlantResourceCollection;

class PlantController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plants = Plant::all();

        return $this->sendResponse(
            data: new PlantResourceCollection($plants),
            message: 'Plants retrieved successfully.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            rules: [
                'name' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:255',
                'path_image' => 'required',
                'user_created' => 'required',
                'date_begin' => 'nullable|date',
                'date_end' => 'nullable|date',
                'is_published' => 'nullable|boolean',
            ]
        );

        $plant = Plant::create($request->all());

        return $this->sendResponse(
            data: new PlantResource($plant),
            message: 'Plant created successfully.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plant = Plant::find($id);

        if (is_null($plant)) {
            return $this->sendError(
                message: 'Plant not found.'
            );
        }

        return $this->sendResponse(
            data: new PlantResource($plant),
            message: 'Plant retrieved successfully.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $plant = Plant::find($id);

        if (is_null($plant)) {
            return $this->sendError(
                message: 'Plant not found.'
            );
        }

        $request->validate(
            rules: [
                'name' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:255',
                'path_image' => 'required',
                'user_created' => 'required',
                'date_begin' => 'nullable|date',
                'date_end' => 'nullable|date',
                'is_published' => 'nullable|boolean',
            ]
        );

        $plant->update($request->all());

        return $this->sendResponse(
            data: new PlantResource($plant),
            message: 'Plant updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plant = Plant::find($id);

        if (is_null($plant)) {
            return $this->sendError(
                message: 'Plant not found.'
            );
        }

        $plant->delete();

        return $this->sendResponse(
            data: [],
            message: 'Plant deleted successfully.'
        );
    }
}
