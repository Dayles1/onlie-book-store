<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
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
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            
      'translations' => ['required', 'array'],
        'translations.*' => ['required', 'array'],
        'translations.*.*' => ['required', 'array'],
        'translations.*.*.title' => ['sometimes', 'required', 'string', 'max:255'],
        'translations.*.*.description' => ['sometimes', 'required', 'string'],

           
        ];
    }
}
