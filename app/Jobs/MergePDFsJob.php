<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class MergePDFsJob implements ShouldQueue
{
    use Batchable,Dispatchable, InteractsWithQueue, Queueable, SerializesModels ;

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
     * @return void
     */
    public function handle()
    {

        //check if the batch if cancelled
        if ($this->batch()->cancelled()) {
            return;
        }

        $oMerger = PDFMerger::init();
        $timeId = $this->data['time'];

        //search in the public folder with the timeId for example /reports
        $folderPath = storage_path('app/public/reports/' . $timeId); // Ruta a la carpeta de almacenamiento

        $files = File::files($folderPath);

        $pdfFiles = array_filter($files, function ($file) {
            return pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
        });

        // Ordena los archivos PDF por nombre
        natcasesort($pdfFiles);

        // Agrega todos los archivos PDF al objeto PDFMerger
        foreach ($pdfFiles as $file) {
            $oMerger->addPDF($file);
        }

        // Combina los archivos PDF
        $oMerger->merge();

        // Elimina el resto de archivos PDF
        foreach ($pdfFiles as $file) {
            unlink($file);
        }

        $mergedFileName = storage_path('app/public/reports/'.$timeId. '/report_'. $timeId.'.pdf'); // Ruta donde se guardará el archivo PDF combinado

        $oMerger->save($mergedFileName);


    }
}
