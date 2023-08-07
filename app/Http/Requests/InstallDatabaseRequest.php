<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstallDatabaseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'website.name' => ['required', 'string'],
            'website.address' => ['required', 'string'],
            'database.host' => ['required', 'string'],
            'database.port' => ['required', 'string'],
            'database.name' => ['required', 'string'],
            'database.username' => ['required', 'string'],
            'database.password' => ['required', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'website.name'  =>   trans('Website name'),
            'website.address'   =>    trans('Website address'),
            'database.host' =>  trans('Database host'),
            'database.port' =>  trans('Database port'),
            'database.name' =>  trans('Database name'),
            'database.username' =>  trans('Database username'),
            'database.password' =>  trans('Database password')
        ];
    }
}
