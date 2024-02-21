<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DemandController extends Controller
{
    public function createDemand(Request $request): JsonResponse
    {
        $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'user_id' => 'required|exists:users,id',
            'message' => 'nullable|string|max:255',
        ]);

        $demand = Demand::create($request->all());

        return $this->successResponse(
            data: $demand,
            message: 'Demand created successfully.'
        );
    }

    public function updateDemandStatus(Request $request, Demand $demand): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $demand->update([
            'status' => 'accepted',
        ]);

        return $this->successResponse(
            data: $demand,
            message: 'Demand accepted successfully.'
        );
    }

    public function destroy(Demand $demand): JsonResponse
    {
        $demand->delete();

        return $this->successResponse(
            data: $demand,
            message: 'Demand deleted successfully.'
        );
    }
}
