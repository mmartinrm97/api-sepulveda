<?php

namespace App\Http\Requests\v1;

use App\Rules\v1\UserWithWarehouseRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreWarehouseRequest extends FormRequest
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
            'description' => 'required|string|unique:warehouses,description',
            'user_id' => ['required','exists:users,id', new UserWithWarehouseRule()],
            'is_active' => 'required|boolean'
        ];
    }
}
