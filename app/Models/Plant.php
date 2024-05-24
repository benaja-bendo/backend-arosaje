<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        title: "Plant",
        description: "Plant model",
        required: ["name"],
        properties: [
            new OA\Property(property: "name", description: "Name of the plant", type: "string"),
            new OA\Property(property: "description", description: "Description of the plant", type: "string"),
            new OA\Property(property: "path_image", description: "Path image of the plant", type: "string"),
            new OA\Property(property: "address", description: "Address of the plant", type: "string"),
            new OA\Property(property: "user_created", description: "User created of the plant", type: "integer"),
            new OA\Property(property: "date_begin", description: "Date begin of the plant", type: "string"),
            new OA\Property(property: "date_end", description: "Date end of the plant", type: "string"),
            new OA\Property(property: "is_published", description: "Is published of the plant", type: "boolean"),
        ],
        type: "object",
        example: [
            "name" => "Plant",
            "description" => "Description",
            "path_image" => "https://example.com/image.jpg",
            "address" => "Address",
            "user_created" => 1,
            "date_begin" => "2021-01-01",
            "date_end" => "2021-01-01",
            "is_published" => true,
            "advices" => [],
            "demands" => [],
            "messages" => [
                "message" => "Message",
                "user_id" => 1,
                "plant_id" => 1,
                "created_at" => "2021-01-01",
                "updated_at" => "2021-01-01",
            ],
        ],

    )
]
class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'path_image',
        'address',
        'user_created',
        'date_begin',
        'date_end',
        'is_published',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_created');
    }

    public function advices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Advice::class);
    }

    public function demands(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Demand::class);
    }

    public function messages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Message::class);
    }
}
