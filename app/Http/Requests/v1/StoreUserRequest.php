<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'role_id' => 'required|exists:roles,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'dni' => 'required|string|size:8',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',

        ];
    }

    public function attributes()
    {
        return [
            'role_id' => 'rol',
            'first_name' => 'nombres',
            'last_name' => 'apellidos',
            'dni' => 'dni',
            'email' => 'email',
            'password' => 'contraseña'
        ];
    }
}
