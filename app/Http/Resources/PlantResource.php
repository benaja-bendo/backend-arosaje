<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlantResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'path_image' => url($this->path_image),
            'user_created' => $this->user_created,
            'user_created_name' => $this->user->name,
            'date_begin' => $this->date_begin,
            'care_tips' => $this->advices,
            'date_end' => $this->date_end,
            'is_published' => $this->is_published,
            'created_at' => $this->created_at->format('d-m-Y'),// ->format('d-m-Y H:i:s')
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
