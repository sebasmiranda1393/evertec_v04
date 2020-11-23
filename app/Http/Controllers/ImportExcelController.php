<?php

namespace App\Http\Controllers;

use App\Exports\ArchivoPrimarioExport;
use App\Imports\CsvDataImport;
use App\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ImportExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {
        $products = Product::with('categoria')->orderBy('id', 'desc')->get();
        return view('excel/excel', compact('products'));
    }

    function show()
    {

        $File = "Archivo Primario";

        $data = array(
            array("id", "name", "description", "purchase_price", "sale_price", "available", "productimg", "status", "category_id")
        );
        $products = Product::with('categoria')->get();

        foreach ($products as $row) {

            array_push($data, array(
                $row->id,
                $row->name,
                $row->description,
                $row->purchase_price,
                $row->sale_price,
                $row->available,
                $row->productimg,
                $row->status,
                $row->category_id
            ));
        }


        $export = new ArchivoPrimarioExport($data);
        return Excel::download($export, $File . '.xlsx');


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'select_file' => 'required|mimes:xls,xlsx'
            ]);

            $path = $request->file('select_file')->getRealPath();
            $data = Excel::import(new CsvDataImport(), $path);
        } catch (Exception $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
        }
    }


}
