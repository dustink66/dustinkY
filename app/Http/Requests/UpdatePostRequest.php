<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'background_image' => 'nullable|boolean',
            'published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
            'views' => 'nullable|integer',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer|exists:categories,id',
        ];
    }
}
