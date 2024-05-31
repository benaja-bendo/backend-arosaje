<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConversationCollection;
use App\Models\Conversation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
//        $conversations = $user->conversations()->with('users')->get();
        $conversations = $user->conversations()->get();
//        $conversations = Conversation::query()->with('users')->get();
        return $this->successResponse(
            data: new ConversationCollection($conversations),
            message: 'Conversations retrieved successfully.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'nullable|string',
//            'user_ids' => 'required|array',
//            'user_ids.*' => 'exists:users,id',
        ]);

        $user = Auth::user();
        $conversation = Conversation::create([
            'name' => $request->name,
            'is_group' => false, // count($request->user_ids) > 1,
            'created_by' => 1, // $user->id,
        ]);

//        $conversation->users()->attach(array_merge($request->user_ids, [$user->id]));
        $conversation->users()->attach([$user->id]);

//        return response()->json($conversation->load('users'), 201);
        return $this->successResponse(
            data: $conversation->load('users'),
            message: 'Conversation created successfully.',
            code: 201
        );
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(Conversation $conversation): \Illuminate\Http\JsonResponse
    {
//        $this->authorize('view', $conversation);
        if (!Auth::user()->can('view', $conversation)) {
//            throw new AuthorizationException('You are not allowed to view this conversation.');
            abort(403, 'You are not allowed to view this conversation.');

        }

//        return response()->json($conversation->load('users'));
        return $this->successResponse(
            data: $conversation->load('users'),
            message: 'Conversation retrieved successfully.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
