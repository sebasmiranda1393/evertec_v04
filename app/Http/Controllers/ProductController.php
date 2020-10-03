<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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
        var_dump($product);

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
    public function show(Request $request, int $id)    {

        $name_search = $request->get('namesearch');
        $valor_search = $request->get('valorsearch');
        $products = Product::select('products.id', 'products.name', 'products.sale_price',
            'products.purchase_price','products.description' ,'categories.category', 'products.available' )
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->where('name', 'like', '%' . $name_search . '%')
            ->where('sale_price', 'like', '%' . $valor_search . '%')
            ->where('status', true)->paginate(4);
        if ($id == 0) {
            return view('product/product', ["products" => $products]);

        } else  if ($id == 1){
            return view('customer/customer_home', ["products" => $products]);
        }
    }

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
        var_dump("entro");
       if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->input('name') . time() . '.' . $extension;
            $file->move('image/products', $filename);
            DB::Table('products')->where('id', $product . $id)->update(
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
        var_dump("entro");
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
}
