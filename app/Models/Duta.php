<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duta extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'name_female', 'kelas', 'title', 'angkatan', 
        'photo', 'photo_webp', 'photo_thumb',
        'photo_couple', 'photo_couple_webp', 'photo_couple_thumb',
        'photo_female', 'photo_female_webp', 'photo_female_thumb', 
        'visi', 'misi', 'visi_female', 'misi_female'
    ];

    protected $casts = [
        'id' => 'integer',
    ];
}
