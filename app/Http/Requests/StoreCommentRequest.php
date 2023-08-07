<?php

namespace App\Http\Requests;

use App\Rules\TextCensor;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'content' => ['required', 'string', new TextCensor],
            'post_id' => 'required|string|exists:posts,ulid',
            'parent_id' => 'nullable|integer|exists:comments,id'
        ];
    }
}
