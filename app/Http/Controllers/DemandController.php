<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class DemandController extends Controller
{
    #[OA\Post(
        path: '/api/v1/plants/{plant}/demands',
        description: 'Create a new demand for a plant.',
        summary: 'Create a new demand',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['plant_id', 'user_id'],
                properties: [
                    new OA\Property(property: 'plant_id', type: 'integer'),
                    new OA\Property(property: 'user_id', type: 'integer'),
                    new OA\Property(property: 'message', type: 'string', maxLength: 255),
                ]
            ),
        ),
        tags: ['Demands'],
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
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

    #[OA\Post(
        path: '/api/v1/plants/{plant}/demands/{demand}/status',
        description: 'Update the status of a demand.',
        summary: 'Update the status of a demand',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['status'],
                properties: [
                    new OA\Property(property: 'status', type: 'string', enum: ['accepted', 'rejected']),
                ]
            ),
        ),
        tags: ['Demands'],
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
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

    #[OA\Delete(
        path: '/api/v1/plants/{plant}/demands/{demand}',
        description: 'Delete a demand.',
        summary: 'Delete a demand',
        tags: ['Demands'],
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ],
    )]
    public function destroy(Demand $demand): JsonResponse
    {
        $demand->delete();

        return $this->successResponse(
            data: $demand,
            message: 'Demand deleted successfully.'
        );
    }
}
