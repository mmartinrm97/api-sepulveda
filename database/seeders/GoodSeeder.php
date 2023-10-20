<?php

namespace Database\Seeders;

use App\Models\Good;
use App\Models\GoodsCatalog;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Good::factory(1000)->create();

//        $data = [];
//
//        $goodsCatalogData = GoodsCatalog::select(['id', 'denomination'])->get()->toArray();
//        $warehouseIDs = Warehouse::pluck('id')->toArray();
//
//        // get the months to finish the year
//        $currentMonth = now()->month;
//
//
//        for ($i = 0; $i <= 10000; $i++) {
//            $goodsCatalog = $goodsCatalogData[array_rand($goodsCatalogData)];
//
//            $stateOfConservation = '';
//            $randomProbabilityStateConservation = rand(0, 100);
//
//            if ($randomProbabilityStateConservation > 50) {
//                $stateOfConservation = 'A';
//            }
//
//            if ($randomProbabilityStateConservation <= 50 && $randomProbabilityStateConservation > 20) {
//                $stateOfConservation = 'B';
//            }
//
//            if ($randomProbabilityStateConservation <= 20) {
//                $stateOfConservation = 'C';
//            }
//            $years = rand(0, 3);
//            $months = rand(0, 2 * $currentMonth);
//            $days = rand(0, 31);
//
//            $data[] = [
//                'code' => fake()->numberBetween(10000000, 90000000),
//                'description' => $goodsCatalog['denomination'],
//                'goods_catalog_id' => $goodsCatalog['id'],
//                'warehouse_id' => $warehouseIDs[array_rand($warehouseIDs)],
////                'trademark' => 'Trademark ' . fake()->word,
////                'model' => 'Model ' . fake()->word(),
////                'type' => fake()->word(),co
//                'color' => fake()->safeColorName(),
//                'series' => fake()->hexcolor(),
//                'state_of_conservation' => $stateOfConservation,
//                'date_acquired' => now()->subYears($years)->subMonths($months)->subDays($days),
//                'value' => fake()->randomFloat(1, 10, 500),
//                'observations' => 'MED',
//                'is_active' => rand(0, 1),
//                'created_at' => now()->subMonths(rand(1, 12))->subDays(rand(1, 30)),
//                'updated_at' => now()->subDays(rand(1, 12))
//            ];
//        }
//
//        //chunk the data
//        $chunks = array_chunk($data, 1000);
//        foreach ($chunks as $chunk) {
//            DB::table('goods')->insert($chunk);
//        }


        $csvFile = fopen(database_path('seeders/data/goods-data.csv'), 'r');
        $firstLine = true;
        $goodData = [];

        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if ($firstLine) {
                $firstLine = false;
                continue; // Salta la primera línea (encabezado)
            }

            $goodData[] = [
                'code' => $data[1],
                'description' => $data[2],
                'goods_catalog_id' => $data[3],
                'warehouse_id' => $data[4],
                'trademark' => $data[5],
                'model' => $data[6],
                'type' => $data[7],
                'color' => $data[8],
                'series' => $data[9],
                'state_of_conservation' =>$data[10],
                'date_acquired' =>$data[11],
                'value' => $data[12],
                'observations' => $data[13],
                'is_active' => $data[14],
                'created_at' => $data[15],
                'updated_at' => $data[16],
            ];
        }

        fclose($csvFile);

        //chunk de $itemsCatalogData to insert on CatalogItem model
        $chunks = array_chunk($goodData, 500);
        foreach ($chunks as $chunk) {
            Good::insert($chunk);
        }

    }
}
