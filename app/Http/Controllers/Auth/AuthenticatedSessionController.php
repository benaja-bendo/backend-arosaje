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

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     * @return JsonResponse
     */
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

    /**
     * Destroy an authenticated session.
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
//        Auth::guard('web')->logout();
//
//        $request->session()->invalidate();
//
//        $request->session()->regenerateToken();
//
//        return response()->noContent();
        return $this->successResponse(null, 'User logged out successfully.');
    }
}
