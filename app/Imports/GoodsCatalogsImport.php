<?php

namespace App\Imports;

use App\Models\GoodsCatalog;
use Maatwebsite\Excel\Concerns\ToModel;

class GoodsCatalogsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new GoodsCatalog([
            'item'     => $row[0],
            'code'    => $row[1],
            'denomination'    => $row[2],
            'goods_group_id'    => $row[3],
            'goods_class_id'    => $row[4],
            'resolution'    => $row[5],
            'is_active'    => true,
        ]);
    }
}
