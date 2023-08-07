<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class InstallUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => 'required|string|min:8',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('Webmaster Name'),
            'email'   =>  trans('Webmaster Email'),
            'password'    =>  trans('Password'),
            'password_confirmation'   =>  trans('Confirm Password')
        ];
    }
}
