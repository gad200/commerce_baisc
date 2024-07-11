<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'subtitle' => 'string|max:255',
            'description' => 'string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'offer' => 'nullable|numeric|min:0|max:80',

            'color' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'category' => 'required|string|max:255',

            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
