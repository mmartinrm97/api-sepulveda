<?php

namespace App\Imports;

use App\Models\Good;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class GoodsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Model|Good|null
     */
    public function model(array $row): Model|Good|null
    {
        return new Good([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password']),
        ]);
    }
}
