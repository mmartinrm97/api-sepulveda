<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoodRequest extends FormRequest
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
            'code' => 'required|string|unique:goods,code',
            'description' => 'required|string',
            'warehouse_id' => 'required|exists:warehouses,id',
            'goods_catalog_id' => 'required|exists:goods_catalogs,id',
            'is_active' => 'required|boolean'
        ];
    }

//    public function messages()
//    {
//        return [
//            'code.required' => 'El campo código es requerido',
//            'code.unique' => 'El campo código ya ha sido registrado',
//            'description.required' => 'El campo descripción es requerido',
//            'warehouse_id.required' => 'El campo Área es requerido',
//            'goods_catalog_id.required' => 'El campo Catálogo es requerido',
//            'is_active.required' => 'El campo Activo es requerido',
//        ];
//    }

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
