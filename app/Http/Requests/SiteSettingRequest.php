<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow only authorized admins if needed
        return true;
    }

    public function rules(): array
    {
        return [
            // Text-based settings
            'site_name_en'       => ['nullable', 'string', 'max:255'],
            'site_name_mm'       => ['nullable', 'string', 'max:255'],
            'address'            => ['nullable', 'string', 'max:500'],
            'email'              => ['nullable', 'email', 'max:255'],
            'footer_desc1'       => ['nullable', 'string'],
            'footer_desc2'       => ['nullable', 'string'],
            'privacy_policy'     => ['nullable', 'string'],
            'terms_of_service'   => ['nullable', 'string'],

            // File/image settings
            'footer_bg_image'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'activities_bg_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Please provide a valid email address.',
            'footer_bg_image.image' => 'Footer background must be an image file.',
            'activities_bg_image.image' => 'Activities background must be an image file.',
        ];
    }

}
