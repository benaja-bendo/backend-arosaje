<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OA;

class AuthenticatedSessionController extends Controller
{
    #[OA\Post(
        path: '/login',
        description: 'Log in a user.',
        summary: 'Log in a user',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email', 'password'],
                properties: [
                    new OA\Property(property: 'email', type: 'string', format: 'email', maxLength: 255),
                    new OA\Property(property: 'password', type: 'string', format: 'password'),
                ]
            ),
        ),
        tags: ['Auth'],
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Invalid credentials'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(LoginRequest $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = User::find(Auth::id());
            $tokenName = 'token-' . $user->id . '-' . now()->timestamp;
            $token = $user->createToken($tokenName)->plainTextToken;
            return $this->successResponse(
                [
                    'token' => $token,
                    'user' => new UserResource($user),
                ], 'User logged in successfully.');
        }

        return $this->errorResponse('Invalid credentials', [], 401);
    }

    #[OA\Delete(
        path: '/logout',
        description: 'Log out a user.',
        summary: 'Log out a user',
        tags: ['Auth'],
        responses: [
            new OA\Response(response: 204, description: 'No content')
        ]
    )]
    public function destroy(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();
//        return $this->successResponse(null, 'User logged out successfully.');
        return response()->noContent();
    }
}
