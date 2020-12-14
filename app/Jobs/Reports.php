<?php

namespace App\Jobs;

use App\Exports\ArchivoPrimarioExport;
use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class Reports
 * @package App\Jobs
 */
class Reports implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( )
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $File = "Archivo Primario";
        $data = array(
            array("id", "name", "description", "purchase_price", "sale_price", "available", "category_id")
        );
        $products = Product::with('categoria')->get();

        foreach ($products as $row) {
            if($row->available==0){
                $row->available="agotado";
            }
            array_push($data, array(
                $row->id,
                $row->name,
                $row->description,
                $row->purchase_price,
                $row->sale_price,
                $row->available,
                $row->categoria->category
            ));
        }


        $export = new ArchivoPrimarioExport($data);
        return Excel::download($export, $File . '.xlsx');
    }
}
