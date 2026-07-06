<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category', 'image', 'image_webp', 'image_thumb'];

    protected $casts = [
        'id' => 'integer',
    ];
}
