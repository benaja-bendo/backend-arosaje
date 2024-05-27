<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PlantResource;
use App\Http\Resources\PlantResourceCollection;
use OpenApi\Attributes as OA;

class PlantController extends ApiController
{
    #[OA\Get(
        path: "/api/v1/plants",
        operationId: "indexPlants",
        description: "Get all plants",
        summary: "List all plants",
        tags: ["Plants"],
        parameters: [
            new OA\Parameter(
                name: "search",
                description: "Search by name",
                in: "query",
                required: false,
                allowEmptyValue: false,
                schema: new OA\Schema(type: "string"),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'successful operation',
                content: [
                    new OA\JsonContent(ref: "#/components/schemas/Plant"),
                ]
            )
        ]
    )]
    public function index(): JsonResponse
    {
        $plants = Plant::query()
            ->orderBy('created_at', 'desc')
//            ->where('is_published', true)
            ->get();

        return $this->successResponse(
            data: new PlantResourceCollection($plants),
            message: 'Plants retrieved successfully.'
        );
    }


    #[OA\Post(
        path: "/api/v1/plants",
        operationId: "storePlant",
        description: "Create a new plant",
        summary: "Create a new plant",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['path_image', 'user_created'],
            )
        ),
        tags: ["Plants"],
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ]

    )]
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'path_image' => 'required|file|mimes:jpeg,jpg,png',
            'user_created' => 'required',
            'date_begin' => 'nullable | date',
            'date_end' => 'nullable | date',
            'is_published' => 'nullable | boolean',
        ]);

        $path_image = null;
        if ($request->hasFile('path_image')) {
            $path_image = saveFileToStorageDirectory($request, 'path_image', 'plants');
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

    #[OA\Get(
        path: "/api/v1/plants/{id}",
        operationId: "showPlant",
        description: "Get plant by id",
        summary: "Get plant",
        tags: ["Plants"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Plant id",
                in: "path",
                required: true,
                allowEmptyValue: false,
                schema: new OA\Schema(type: "string"),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'successful operation',
                content: [
                    new OA\JsonContent(ref: "#/components/schemas/Plant"),
                ]
            ),
            new OA\Response(
                response: 404,
                description: 'Plant not found',
                content: [
                    new OA\JsonContent(
                        example: [
                            "success" => false,
                            "message" => "Plant not found . "
                        ]
                    )
                ]
            )
        ]
    )]
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

    #[OA\Put(
        path: "/api/v1/plants/{id}",
        operationId: "updatePlant",
        description: "Update plant by id",
        summary: "Update plant",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['path_image', 'user_created'],
            )
        ),
        tags: ["Plants"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Plant id",
                in: "path",
                required: true,
                allowEmptyValue: false,
                schema: new OA\Schema(type: "string"),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'successful operation',
                content: [
                    new OA\JsonContent(ref: "#/components/schemas/Plant"),
                ]
            ),
            new OA\Response(
                response: 404,
                description: 'Plant not found',
                content: [
                    new OA\JsonContent(
                        example: [
                            "success" => false,
                            "message" => "Plant not found . "
                        ]
                    )
                ]
            )
        ]
    )]
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
            message: 'Plant updated successfully'
        );
    }

    #[OA\Delete(
        path: "/api/v1/plants/{id}",
        operationId: "destroyPlant",
        description: "Delete plant by id",
        summary: "Delete plant",
        tags: ["Plants"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Plant id",
                in: "path",
                required: true,
                allowEmptyValue: false,
                schema: new OA\Schema(type: "string"),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'successful operation',
                content: [
                    new OA\JsonContent(
                        example: [
                            "success" => true,
                            "message" => "Plant deleted successfully"
                        ]
                    )
                ]
            ),
            new OA\Response(
                response: 404,
                description: 'Plant not found',
                content: [
                    new OA\JsonContent(
                        example: [
                            "success" => false,
                            "message" => "Plant not found . "
                        ]
                    )
                ]
            )
        ]
    )]
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
            message: 'Plant deleted successfully'
        );
    }

    #[OA\Get(
        path: "/api/v1/plants/me/{id}",
        operationId: "getMyPlants",
        description: "Get my plants",
        summary: "Get my plants",
        tags: ["Plants"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "User id",
                in: "path",
                required: true,
                allowEmptyValue: false,
                schema: new OA\Schema(type: "string"),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'successful operation',
                content: [
                    new OA\JsonContent(ref: "#/components/schemas/Plant"),
                ]
            ),
            new OA\Response(
                response: 404,
                description: 'My plants not found',
                content: [
                    new OA\JsonContent(
                        example: [
                            "success" => false,
                            "message" => "My plants not found"
                        ]
                    )
                ]
            )
        ]
    )]
    public function getMyPlants(string $id): JsonResponse
    {
        $plants = Plant::where('user_created', $id)->get();

        if ($plants->isEmpty()) {
            return $this->errorResponse(
                error: 'My plants not found'
            );
        }

        return $this->successResponse(
            data: new PlantResourceCollection($plants),
            message: 'My plants retrieved successfully'
        );
    }
}
