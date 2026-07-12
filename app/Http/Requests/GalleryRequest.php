<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'    => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'image'    => $this->route('gallery') ? 'nullable|image|max:51200' : 'required|image|max:51200',
        ];
    }
}
