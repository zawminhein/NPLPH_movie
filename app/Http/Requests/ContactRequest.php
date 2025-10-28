<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'mail' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'desc_en.required' => 'The desc_en field is required.',
            'desc_mm.required' => 'The desc_mm field is required.',
            'mail.required' => 'The mail field is required.',
            'phone.required' => 'The phone field is required.',
            'address.required' => 'The address field is required.',
        ];
    }
}
