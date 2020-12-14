<?php

namespace App\Http\Controllers;

use App\Exports\ArchivoPrimarioExport;
use App\Imports\CsvDataImport;
use App\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ImportProductController extends Controller
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
            $products = Product::with('categoria')->orderBy('id', 'desc')->get();
            return view('reports/report');

        } catch (Exception $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
        }
    }


}
