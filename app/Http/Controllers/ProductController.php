<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;
use Illuminate\View\View;

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

    public function create()
    {
        return view('product/create_products');
    }

    public function save(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->purchase_price = $request->input('price_sell');
        $product->sale_price = $request->input('price-buy');
        $product->available = $request->input('quantity');
        $product->category_id = 1;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->input('name') . time() . '.' . $extension;
            $file->move('image/products', $filename);
            $product->productimg = $request->input('picture');
            $product->productimg = $filename;

        }
        $product->save();
    }

    public function update($id, Request $request)
    {
        echo $request->input('status');
        DB::Table('products')->where('id', $id)->update(
            array(
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'purchase_price' => $request->get('purchase_price'),
                'sale_price' => $request->get('sale_price'),
                'available' => $request->get('available'),
                'status' => $request->get('status')
            )
        );
        return redirect()->route('product');

    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('product/editProducts', ["product" => $product]);
    }

    public function search(Request $request)
    {
        $namesearch = $request->get('namesearch');
        $valorsearch = $request->get('valorsearch');
        $products = DB::Table('products')->where('name', 'like', '%' . $namesearch . '%' )
                                         ->where('sale_price', 'like', '%' . $valorsearch . '%')->paginate(5);
        return view('product', ["products" => $products]);


    }

}
