<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DutaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255',
            'name_female'  => 'nullable|string|max:255',
            'kelas'        => 'required|string|max:100',
            'title'        => 'required|string|max:255',
            'angkatan'     => 'nullable|string|max:50',
            'photo'        => 'nullable|image|max:51200',
            'photo_couple' => 'nullable|image|max:51200',
            'photo_female' => 'nullable|image|max:51200',
            'visi'         => 'nullable|string',
            'misi'         => 'nullable|string',
            'visi_female'  => 'nullable|string',
            'misi_female'  => 'nullable|string',
        ];
    }
}
