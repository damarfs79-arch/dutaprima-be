<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaSeleksi extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kelas', 'status', 'keterangan', 'wawancara', 'bakat'];
}
