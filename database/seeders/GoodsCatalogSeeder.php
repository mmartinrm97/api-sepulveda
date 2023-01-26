<?php

namespace Database\Seeders;

use App\Imports\GoodsCatalogsImport;
use App\Models\GoodsCatalog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class GoodsCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GoodsCatalog::factory(10)->create();
//        Excel::import(new GoodsCatalogsImport, 'bienes3.xlsx','public');
    }
}
