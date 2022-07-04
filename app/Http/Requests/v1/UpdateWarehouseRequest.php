<?php

namespace App\Http\Requests\v1;

use App\Rules\v1\UserWithWarehouseRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWarehouseRequest extends FormRequest
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
            'description' => ['string',
                Rule::unique('warehouses', 'description')->ignore($this->route('warehouse'))],
            'user_id' => ['exists:users,id', new UserWithWarehouseRule()],
            'is_active' => 'boolean'
        ];
    }
}
