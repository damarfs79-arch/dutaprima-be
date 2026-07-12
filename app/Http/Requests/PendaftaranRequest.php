<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendaftaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama'               => 'required|string|max:255',
            'nama_kelas_jurusan' => 'required|string|max:100',
            'ttl'                => 'required|string|max:255',
            'bakat'              => 'required|string|max:255',
            'prestasi'           => 'nullable|string',
            'file_prestasi'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:51200',
            'motivasi'           => 'nullable|string',
            'foto_full'          => 'required|file|mimes:jpg,jpeg,png,pdf|max:51200',
            'foto_half'          => 'required|file|mimes:jpg,jpeg,png,pdf|max:51200',
            'whatsapp'           => 'required|string|max:20',
            'instagram'          => 'nullable|string|max:255',
            'tiktok'             => 'nullable|string|max:255',
        ];
    }
}
