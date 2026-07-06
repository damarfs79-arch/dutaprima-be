<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KandidatVoting extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kategori', 'popularitas', 'suara', 'foto'];

    public function getFotoAttribute($value)
    {
        if (!$value) return null;

        if (str_contains($value, '/storage/')) {
            return '/storage/' . explode('/storage/', $value, 2)[1];
        }

        return $value;
    }
}
