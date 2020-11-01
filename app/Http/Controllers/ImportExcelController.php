<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\CsvDataImport;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
}
