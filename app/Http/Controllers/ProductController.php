<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('product/product', ['products' => Product::with('categoria')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product/product_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $product = Product::find($id);
        return view('product/product_edit', ["product" => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update( Request  $request, Product $product)
    {

       if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->input('name').time().'.'.$extension;
            $file->move('image/products', $filename);
            DB::Table('products')->where('id', $product->id)->update(
                array(
                    'productimg' => $filename
                )
            );
        }
        DB::Table('products')->where('id', $product->id)->update(
            array(
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'purchase_price' => $request->get('purchase_price'),
                'sale_price' => $request->get('sale_price'),
                'available' => $request->get('available'),
                'status' => $request->get('status')
            )
        );
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from the session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $product = session::forget('product', $id)->first();
        $product->destroy($id);
        return redirect()->back()->with('message', 'task deleted!');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function back()
    {
        return redirect()->route('product');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function description(int $id)
    {
        $product = Product::find($id);
        return view('product/product_description', ["product" => $product]);

    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home(Request $request, int $id)
    {
        $namesearch = $request->get('namesearch');
        $valorsearch = $request->get('valorsearch');
        $products = DB::Table('products')->where('name', 'like', '%' . $namesearch . '%')
            ->where('sale_price', 'like', '%' . $valorsearch . '%')
            ->where('status', true)->paginate(4);

        if ($id == 0) {
            return view('product', ["products" => $products]);

        } else {
            return view('product/welcome', ["products" => $products]);
        }
    }
    public function show(Request $request, int $id)
    {
        $namesearch = $request->get('namesearch');
        $valorsearch = $request->get('valorsearch');
        $products = DB::Table('products')->where('name', 'like', '%' . $namesearch . '%')
            ->where('sale_price', 'like', '%' . $valorsearch . '%')
            ->where('status', true)->paginate(4);

        if ($id == 0) {
            return view('admin/home_admin', ["products" => $products]);

        } else {
            return view('customer/customer_home', ["products" => $products]);
        }
    }
}
