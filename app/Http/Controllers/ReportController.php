<?php

namespace App\Http\Controllers;

use App\CartProduct;
use App\Exports\ArchivoPrimarioExport;
use App\Product;
use Illuminate\Http\Request;
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
        $products = CartProduct::select('products.id', 'products.name', DB::raw('sum(cart_products.quantity) as available'))
            ->join('products', 'products.id', '=', 'cart_products.product_id')
            ->where('cart_products.created_at', 'LIKE', $request->input('date') . '%')
            ->groupBy('cart_products.product_id')
            ->orderBy('available', 'DESC')
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
        return view('reports/report_home', ["products" => $products]);
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

    public function view()
    {
        return view('reports/report_home');
    }

    public function stockProducts(Request $request)
    {
        $ordenamiento = "=";
        if ($request->input('mayor') != null) {
            $ordenamiento = ">=";
        } else if ($request->input('menor') != null) {
            $ordenamiento = "<=";

        }


        $products = Product::select('products.id', 'products.name', 'products.description', 'products.available as available')
            ->where('products.available', $ordenamiento, $request->input('cantidad'))
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
        return view('reports/report_home', ["products" => $products]);
    }

    public function higher_quantity(Request $request)
    {
        $products = Product::select('products.id', 'products.name', 'products.description', 'products.available as available')
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
        return view('reports/report_home', ["products" => $products]);

    }

    public function less_quantity(Request $request)
    {
        $products = Product::select('products.id', 'products.name', 'products.description', 'products.available as available')
            ->orderBy('products.available', 'ASC')
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
                $row->min
            ));
        }
        return view('reports/report_home', ["products" => $products]);
    }


    public function download_report(Request $request)
    {

        $File = "Producto mas vendido";
        $products = $request->input('product');
        $data = array(
            array("id", "nombre del producto", "descripción del producto", "cantidad total")
        );

        if (!empty($products)) {
            $manage = json_decode($products, true);

            if (is_array($manage) || is_object($manage)) {
                foreach ($manage as $row) {
                   array_push($data,
                       array(
                            $row["id"],
                            $row["name"],
                            $row["description"],
                            $row["available"]
                        )
                    );
                }
            }

        }
      $export = new ArchivoPrimarioExport($data);
        return Excel::download($export, $File . '.xlsx');
    }

    public function back()
    {
        return view('reports/report');
    }

}
