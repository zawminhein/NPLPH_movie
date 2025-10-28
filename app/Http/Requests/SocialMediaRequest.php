<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaRequest extends FormRequest
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
            'facebook_link' => 'nullable|string',
            'youtube_link' => 'nullable|string',
            'tiktok_link' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'facebook_link.string' => 'The facebook link must be a string.',
            'youtube_link.string' => 'The youtube link must be a string.',
            'tiktok_link.string' => 'The tiktok link must be a string.',
        ];
    }
}
