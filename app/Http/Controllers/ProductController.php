<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $products = Product::all();
        // var_dump(Product::with('categoria')->get());
        return view('product/product', ['products' => Product::with('categoria')->get()]);
        //  $products = Product->categoria();
        //return view('product/product', ["products" => $products]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function create()
    {
        return view('product/product_create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
        return redirect()->route('product');

    }


    /**
     * @param Product $product
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Product $product, Request $request)
    {

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
        return redirect()->route('product');

    }


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function edit(Product $product)

    {
        $product = Product::find($product->id);
        return view('product/product_edit', ["product" => $product]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function search(Request $request, int $id)
    {
        $namesearch = $request->get('namesearch');
        $valorsearch = $request->get('valorsearch');
        $products = DB::Table('products')->where('name', 'like', '%' . $namesearch . '%')
            ->where('sale_price', 'like', '%' . $valorsearch . '%')
            ->where('status', true)->paginate(4);

        if ($id == 0) {
            return view('product/product', ["products" => $products]);

        } else {
            return view('customer/customer_home', ["products" => $products]);
        }
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function back()
    {
        return redirect()->route('product');
    }


    public function delete($id)
    {
        $product = session::forget('product', $id)->first();
        $product->destroy($id);
        return redirect()->back();
    }

}
