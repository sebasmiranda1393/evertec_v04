<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Integer;

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
        return view('product', ["products" => $products]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function create()
    {
        return view('product/create_products');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
        return redirect()->route('product');
    }

    public function cart()
    {
        return view('cart/cart');
    }

    public function addToCart($id)
    {
        $product = Product::find($id);

        if(!$product) {

            abort(404);

        }
        $cart = session()->get('cart');

        // if cart is empty then this the first product
        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->sale_price,
                    "photo" => $product->productimg
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->sale_price,
            "photo" => $product->productimg
        ];

        session()->put('cart', $cart);


        return redirect()->back()->with('success', 'Product added to cart successfully!');

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
        return view('product/editProducts', ["product" => $product]);
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
            return view('product', ["products" => $products]);

        } else {
            return view('customer/homeCustomer', ["products" => $products]);
        }
    }

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

    public function description(Request $request, int $i)
    {
        $products = Product::all();
        return view('product/description_products', ["products" => $products]);
    }
}
