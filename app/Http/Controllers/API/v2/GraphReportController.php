<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Controllers\Controller;
use App\Models\Good;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class GraphReportController extends Controller
{
    //get the goods total by its state_of_conservation and sort by state of conservation
    public function getGoodsTotalByStateOfConservation(): JsonResponse
    {

        $bienesPorEstado = Good::select('state_of_conservation', DB::raw('count(*) as total'))
            ->groupBy('state_of_conservation')
            ->orderBy('state_of_conservation')
            ->get();

        return response()->json([
            'data' => $bienesPorEstado
        ]);
    }

    //Get the total of the assets by their date_acquired grouped by years, and each by their months.
    public function getGoodsTotalByDateAcquired(): JsonResponse
    {

        $data = Good::select(DB::raw('YEAR(date_acquired) as year'), DB::raw('MONTH(date_acquired) as month'), DB::raw('count(*) as total'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Reorganiza los datos para agrupar por año
        $groupedData = $data->groupBy('year');

        $result = $groupedData->map(function ($items, $year) {
            // Crea un arreglo para almacenar los totales por mes
            $monthlyTotals = array_fill(1, 12, 0);

            // Llena los totales reales de los meses existentes
            $items->each(function ($item) use (&$monthlyTotals) {
                $monthlyTotals[$item->month] = $item->total;
            });

            // Convierte el arreglo en una estructura de objetos por mes
            $monthlyData = collect($monthlyTotals)->map(function ($total, $month) {
                return [
                    'month' => date('F', mktime(0, 0, 0, $month, 1)),
                    'total' => $total,
                ];
            })->values(); // Usar 'values()' para reiniciar los índices

            return [
                'year' => (int)$year,
                'totals_by_month' => $monthlyData,
            ];
        })->values(); // Usar 'values()' para reiniciar los índices

        return response()->json([
            'data' => $result
        ]);
    }

    //generate a function to get the top 10 of the warehouses with the highest total value goods
    public function getWarehousesWithHighestTotalValueGoods(): JsonResponse
    {
        $warehouses = DB::table('warehouses')
            ->join('goods', 'warehouses.id', '=', 'goods.warehouse_id')
            ->select(
                'warehouses.id',
                'warehouses.description',
                DB::raw('ROUND(SUM(goods.value), 2) as total_value'),
                DB::raw('COUNT(goods.id) as total_goods')
            )
            ->groupBy('warehouses.id', 'warehouses.description')
            ->orderByDesc('total_value')
            ->limit(5) // Limitar a los 10 primeros resultados
            ->get();

        return response()->json([
            'data' => $warehouses
        ]);
    }

}
