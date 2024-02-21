<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function user() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_created');
    }

    public function advices() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Advice::class);
    }

    public function demands() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Demand::class);
    }

    public function messages() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Message::class);
    }
}
