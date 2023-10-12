<?php

namespace Database\Seeders;

use App\Imports\GoodsCatalogsImport;
use App\Models\GoodsCatalog;
use App\Models\GoodsClass;
use App\Models\GoodsGroup;
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
//        GoodsCatalog::factory(10)->create();
//        Excel::import(new GoodsCatalogsImport, 'bienes3.xlsx','public');

        $goodGroups = GoodsGroup::select(['id','description'])->get();
        $goodClasses = GoodsClass::select(['id','description'])->get();

        $csvFile = fopen(base_path('database/seeders/data/CatalogoDataSBN.csv'), 'r');
        $firstLine = true;
        $goodsData = [];

        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if ($firstLine) {
                $firstLine = false;
                continue; // Salta la primera línea (encabezado)
            }
            $goodGroup = $goodGroups->firstWhere('description', $data[3]);
            $goodClass = $goodClasses->firstWhere('description', $data[4]);

            $goodsData[] = [
                'item' => $data[0],
                'code' => $data[1],
                'denomination' => $data[2],
                'goods_group_id' => $goodGroup ? $goodGroup->id : null,
                'goods_class_id' => $goodClass ? $goodClass->id : null,
                'resolution' => $data[5],
                'is_active' => $data[6] === 'ACTIVO',
            ];
        }

        fclose($csvFile);

        //chunk de $itemsCatalogData to insert on CatalogItem model
        $chunks = array_chunk($goodsData, 500);
        foreach ($chunks as $chunk) {
            GoodsCatalog::insert($chunk);
        }
    }
}
