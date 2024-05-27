<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageCollection;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OA;

class MessageController extends Controller
{

    #[OA\Get(
        path: 'api/v1/messages/users/{user_id}/rooms',
        description: 'Get all rooms for a user.',
        summary: 'Get all rooms for a user.',
        security: [['sanctum' => []]],
        tags: ['Messages'],
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ],
    )]
    public function rooms(Request $request, int $user_id): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
        ]);
//    $userId = $request->input('user_id') ?? $request->user_id;
        $conversations = DB::table('messages')
            ->select(DB::raw('LEAST(sender_id, receiver_id) as user1, GREATEST(sender_id, receiver_id) as user2'))
            ->where('sender_id', $user_id)
            ->orWhere('receiver_id', $user_id)
            ->groupBy('user1', 'user2')
            ->get();

        $rooms = [];
        foreach ($conversations as $conversation) {
            $messages = Message::where('sender_id', $conversation->user1)
                ->where('receiver_id', $conversation->user2)
                ->orderBy('created_at', 'desc')
                ->get();

            $rooms[] = [
                'user1' => $conversation->user1,
                'user2' => $conversation->user2,
                'messages' => $messages,
            ];
        }

        return $this->successResponse(
            data: $rooms,
            message: 'Rooms retrieved successfully.'
        );
    }

    #[OA\Get(
        path: 'api/v1/messages/plants',
        description: 'Get all messages for a room.',
        summary: 'Get all messages for a room.',
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['sender_id', 'receiver_id', 'plant_id'],
            )),
        tags: ['Messages'],
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ],
    )]
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'plant_id' => 'required|exists:plants,id',
        ]);

        $messages = Message::query()
            ->where('sender_id', $request->sender_id)
            ->where('receiver_id', $request->receiver_id)
            ->where('plant_id', $request->plant_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return $this->successResponse(
            data: new MessageCollection($messages),
            message: 'Demand created successfully.'
        );
    }

    #[OA\Post(
        path: 'api/v1/messages/create',
        description: 'Create a new message.',
        summary: 'Create a new message.',
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['sender_id', 'receiver_id', 'plant_id', 'message'],
            )),
        tags: ['Messages'],
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ],
    )]
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'plant_id' => 'required|exists:plants,id',
            'message' => 'required|string',
            'is_read' => 'nullable|boolean',
        ]);

        $message = Message::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'plant_id' => $request->plant_id,
            'message' => $request->message,
            'is_read' => $request->is_read ?? false,
        ]);

        return $this->successResponse(
            data: $message,
            message: 'Message created successfully.'
        );
    }


    #[OA\Delete(
        path: 'api/v1/messages/users/{user_id}/messages/{message_id}',
        description: 'Delete a message.',
        summary: 'Delete a message.',
        security: [['sanctum' => []]],
        tags: ['Messages'],
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ],
    )]
    public function destroy(int $user_id, int $message_id): \Illuminate\Http\JsonResponse
    {
        $message = Message::query()
            ->where('id', $message_id)
            ->where(function ($query) use ($user_id) {
                $query->where('sender_id', $user_id)
                    ->orWhere('receiver_id', $user_id);
            })
            ->first();

        if ($message === null) {
            return $this->errorResponse(
                error: 'Message not found.',
                code: 404
            );
        }

        $message->delete();

        return $this->successResponse(
            data: null,
            message: 'Message deleted successfully.'
        );
    }
}
