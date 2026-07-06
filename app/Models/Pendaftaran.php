<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nama_kelas_jurusan',
        'ttl',
        'bakat',
        'prestasi',
        'file_prestasi',
        'motivasi',
        'foto_full',
        'foto_full_webp',
        'foto_full_thumb',
        'foto_half',
        'foto_half_webp',
        'foto_half_thumb',
        'is_read',
        'whatsapp',
        'instagram',
        'tiktok',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
