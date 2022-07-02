<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGoodRequest extends FormRequest
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
            'code' => ['string', Rule::unique('goods', 'code')->ignore($this->route('good'))],
            'description' => 'string',
            'warehouse_id' => 'exists:warehouses,id',
            'goods_catalog_id' => 'exists:goods_catalogs,id',
            'is_active' => 'boolean'
        ];
    }

    public function attributes()
    {
        return [
            'code' => 'Código',
            'description' => 'Descripción',
            'warehouse_id' => 'Área',
            'goods_catalog_id' => 'Catálogo',
        ];
    }
}
