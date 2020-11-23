<?php

namespace App\Http\Controllers;

use App\CartProduct;
use App\Exports\ArchivoPrimarioExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class InformesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $File = "Producto mas vendido";
        $products = CartProduct::select('products.id', 'products.name', DB::raw('sum(cart_products.quantity) as sum'))
            ->join('products', 'products.id', '=', 'cart_products.product_id')
            ->groupBy('cart_products.product_id')
            ->orderBy('sum','DESC')
            ->limit('1')
            ->get();


        $data = array(
            array("id", "name", "suma")
        );
        foreach ($products as $row) {
            array_push($data, array(
                $row->id,
                $row->name,
                $row->sum
            ));
        }
        $export = new ArchivoPrimarioExport($data);
        return Excel::download($export, $File . '.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
