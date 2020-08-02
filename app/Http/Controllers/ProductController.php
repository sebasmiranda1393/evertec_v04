<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $products = Product::all();
        return view('product', ["products" => $products]);
    }

    public function create(Request $request)
    {
        return view('product/create_products');
    }

    public function save(Request $request)
    {

        $product = new Product();
       $product->name=$request->input('name');
        echo ("aqui funciona2");
        $product->description=$request->input('description');
        $product->purchase_price=$request->input('price_sell');
        $product->sale_price=$request->input('price-buy');
        $product->available =$request->input('quantity');
        echo ("aqui funciona");
        $product->productimg=$request->input('image');
        $product->category_id =1;
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('products',$filename);

        }
        var_dump($request->hasfile('image'));
        var_dump($request->input('name'));
        $product->save();
    }
}
