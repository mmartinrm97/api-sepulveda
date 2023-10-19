<?php

namespace App\Jobs;


use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GeneratePDFJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }


    /**
     * Execute the job.
     *
     * @return \Illuminate\Http\Response
     */
    public function handle()
    {
        //check if the batch if cancelled
        if ($this->batch()->cancelled()) {
            return;
        }


        $warehouse = $this->data['warehouse'];
        $goods = $this->data['goods'];
        $timeId = $this->data['time'];

        $pdf = PDF::loadView('reports.reporte', ['warehouse' => $warehouse, 'goods' => $goods])
            ->setPaper('a4', 'landscape');

        $pdfFilePath = '/reports/'. $timeId .'/warehouse_' . $warehouse->id . '_report_page_'. $goods->currentPage() . '.pdf';
        Storage::disk('public')->put($pdfFilePath, $pdf->output());

    }
}
