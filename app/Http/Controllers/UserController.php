<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResourceCollection;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();

        return $this->successResponse(
            data: new UserResourceCollection($users),
            message: 'Users retrieved successfully.'
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate(
            rules: [
                'name' => 'nullable|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'profile_photo_path' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg|max:2048',
            ]
        );

        if ($request->hasFile('profile_photo_path')) {
            $request->profile_photo_path = saveFileToStorageDirectory($request, 'profile_photo_path', 'profile-photos');
        }

        $user = User::create($request->all());

        return $this->successResponse(
            data: new UserResource($user),
            message: 'User created successfully.'
        );
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id) : JsonResponse
    {
        $user = User::findOrFail($id);

        return $this->successResponse(
            data: new UserResource($user),
            message: 'User retrieved successfully.'
        );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, string $id) : JsonResponse
    {
        $user = User::findOrFail($id);

        $request->validate(
            rules: [
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
            ]
        );

        $user->update($request->all());

        return $this->successResponse(
            data: new UserResource($user),
            message: 'User updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(string $id) : JsonResponse
    {
        $user = User::findOrFail($id);

        $user->delete();

        return $this->successResponse(
            data: new UserResource($user),
            message: 'User deleted successfully.'
        );
    }

    public function changeProfilePhoto(Request $request, string $id) : JsonResponse
    {
        $user = User::findOrFail($id);

        $request->validate(
            rules: [
                'profile_photo_path' => 'required|file|mimes:jpg,jpeg,png,gif,svg|max:2048',
            ]
        );

        $user->profile_photo_path = saveFileToStorageDirectory($request, 'profile_photo_path', 'profile-photos');
        $user->save();

        return $this->successResponse(
            data: new UserResource($user),
            message: 'Profile photo updated successfully.'
        );
    }
}
