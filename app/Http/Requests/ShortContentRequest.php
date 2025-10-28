<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShortContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title_en' => 'required|string|max:255',
            'title_mm' => 'required|string|max:255',
            'desc_en' => 'required|string',
            'desc_mm' => 'required|string',
            'youtube_url' => 'nullable|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title_en.required' => 'Title in English is required.',
            'title_mm.required' => 'Title in Myanmar is required.',
            'desc_en.required' => 'Description in English is required.',
            'desc_mm.required' => 'Description in Myanmar is required.',
        ];
    }
}
