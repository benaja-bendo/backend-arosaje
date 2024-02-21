<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    public function createInteraction(Request $request): JsonResponse
    {
        $request->validate([
            'user_created' => 'required|exists:users,id',
            'user_gardien' => 'required|exists:users,id',
            'message' => 'nullable|string|max:255',
        ]);

        $interaction = Interaction::create($request->all());

        return $this->successResponse(
            data: $interaction,
            message: 'Interaction created successfully.'
        );
    }
}
