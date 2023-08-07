<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'title' => ['string', 'max:255', 'unique:categories,title,' . $this->route('category')->id],
            'slug' => ['required', 'regex:/^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$/', 'max:255', 'unique:categories,slug,' . $this->route('category')->id],
            'parent_id' => 'nullable|integer',
            'description' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => trans('category.title_required'),
            'title.max' => trans('category.title_max'),
            'title.string' => trans('category.title_string'),
            'title.unique' => trans('category.title_unique'),
            'slug.required' => trans('category.slug_required'),
            'slug.regex' => trans('category.slug_regex'),
            'slug.max' => trans('category.slug_max'),
            'slug.unique' => trans('category.slug_unique'),
            'parent_id.integer' => trans('category.parent_id_integer'),
            'description.max' => trans('category.description_max'),
            'description.string' => trans('category.description_string')
        ];
    }
}
