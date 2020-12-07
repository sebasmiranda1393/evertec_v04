<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartProduct;
use App\Exports\ArchivoPrimarioExport;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportByDateTopSellingProduct(Request $request)
    {


       $File = "Producto mas vendido";
        $products = CartProduct::select('products.id', 'products.name', DB::raw('sum(cart_products.quantity) as sum'))
            ->join('products', 'products.id', '=', 'cart_products.product_id')
            ->where('cart_products.created_at','LIKE', $request->input('date').'%')
            ->groupBy('cart_products.product_id')
            ->orderBy('sum', 'DESC')
            ->limit('1')
            ->get();


        $data = array(
            array("id", "nombre del producto", "cantidad total")
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
        return view('reports/report');
    }

    public function higher_quantity(Request $request)
    {

       $File = "Producto con mayor cantidad de existencia";

        $products = Product::select( 'products.id', 'products.name', 'products.description','products.available as max')
            ->orderBy('products.available', 'DESC')
            ->limit($request->input('cantidad'))
             ->get();


        $data = array(
            array("id", "nombre del producto", "descripción del producto", "cantidad total")
        );
        foreach ($products as $row) {
            array_push($data, array(
                $row->id,
                $row->name,
                $row->description,
                $row->max
            ));
        }
        $export = new ArchivoPrimarioExport($data);
        return Excel::download($export, $File . '.xlsx');
    }

    public function less_quantity(Request $request)
    {
        $ordenamiento = "=";

        if($request->input('mayor')!=null){
            $ordenamiento = ">=";
        }else if($request->input('menor')!=null){
            $ordenamiento = "<=";
        }

         $File = "Producto con menor cantidad de existencia";

         $products = Product::select( 'products.id', 'products.name', 'products.description','products.available as min')
             ->where('products.available',$ordenamiento, $request->input('cantidad'))
             ->get();


         $data = array(
             array("id", "nombre del producto", "descripción del producto", "cantidad total")
         );
         foreach ($products as $row) {
             array_push($data, array(
                 $row->id,
                 $row->name,
                 $row->description,
                 $row->min
             ));
         }
         $export = new ArchivoPrimarioExport($data);
         return Excel::download($export, $File . '.xlsx');
    }

    public function mayorUnidades(Request $request)
    {
        $File = "Producto con menor cantidad de existencia";

        $products = Product::select( 'products.id', 'products.name', 'products.description','products.available as min')
            ->where('products.available','>', $request->input('cantidad'))
            ->orderBy('products.available', 'ASC')
            ->get();


        $data = array(
            array("id", "nombre del producto", "descripción del producto", "cantidad total")
        );
        foreach ($products as $row) {
            array_push($data, array(
                $row->id,
                $row->name,
                $row->description,
                $row->min
            ));
        }
        $export = new ArchivoPrimarioExport($data);
        return Excel::download($export, $File . '.xlsx');
    }


}
