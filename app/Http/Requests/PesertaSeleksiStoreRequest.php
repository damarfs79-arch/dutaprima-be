<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PesertaSeleksiStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama'       => 'required|string|max:255',
            'kelas'      => 'required|string|max:100',
            'status'     => 'required|in:lolos,tidak_lolos',
            'keterangan' => 'nullable|string|max:255',
            'wawancara'  => 'nullable|string|max:255',
            'bakat'      => 'nullable|string|max:255',
        ];
    }
}
