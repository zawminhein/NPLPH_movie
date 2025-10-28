<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutContentRequest extends FormRequest
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
            'desc_en' => 'required|string',
            'desc_mm' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'image_url.required' => 'The image field is required.',
            'image_url.image' => 'The image field must be an image.',
            'image_url.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image_url.max' => 'The image field may not be greater than 2MB.',
        ];
    }
}
