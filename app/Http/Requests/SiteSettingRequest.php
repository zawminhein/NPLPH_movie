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
            'settings' => 'required|array|min:1',
            'settings.*.key' => 'required|string|exists:site_settings,key',
            'settings.*.value' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'settings.*.key.required' => 'Setting key is required.',
            'settings.*.key.exists' => 'Setting key does not exist.',
        ];
    }
}
