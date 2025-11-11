<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentUploadRequest extends FormRequest
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
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
        ];
    }

    public function messages(): array
    {
        return [
            'images.required' => 'The images field is required.',
            'images.array' => 'The images field must be an array.',
            'images.*.image' => 'The images field must be an image.',
            'images.*.mimes' => 'The images field must be a file of type: jpeg, png, jpg, gif.',
            'images.*.max' => 'The images field may not be greater than 2MB.',
        ];
    }
}
