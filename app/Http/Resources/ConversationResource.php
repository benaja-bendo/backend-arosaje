<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sender_id' => $this->creator->id,
            'sender' => $this->creator->name,
            'participant' => $this->participant->name,
            'participant_id' => $this->participant_id,
            "messages" => MessageResource::collection($this->messages),
        ];
    }
}
