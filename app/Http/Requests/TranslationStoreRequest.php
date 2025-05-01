<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TranslationStoreRequest extends FormRequest
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
                'key' => 'required|unique:translations',
                'value' => 'required',
                'lang_prefix' => 'required|exists:locales,code',
                'is_active' => 'nullable|boolean',
                // 'locale' => 'required|string',
        ];
    }
}
