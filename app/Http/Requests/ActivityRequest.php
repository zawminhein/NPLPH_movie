<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
            'image_url' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title_en.required' => 'The title_en field is required.',
            'title_mm.required' => 'The title_mm field is required.',
            'desc_en.required' => 'The desc_en field is required.',
            'desc_mm.required' => 'The desc_mm field is required.',
        ];
    }
}
