<?php namespace App\Http\Controllers;

use App\Cart;
use App\CartProduct;
use App\Product;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function cart()
    {
        return view('cart/cart');
    }


    public function guardarCarrito()
    {
        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->save();

        foreach(session()->get('cart') as $key => $value){
            $cartDetails = new CartProduct();
            $cartDetails->cart_id = $cart->id;
            $cartDetails->product_id = $value["id"];
            $cartDetails->quantity = $value["quantity"];
            $cartDetails->save();
        }



    }


    public function addToCart($id)
    {
        $product = Product::find($id);
        if (!$product) {

            abort(404);

        }
        $cart = session()->get('cart');


       if (!$cart) {

            $cart = [
                $id => [
                    "id" => $product->id,
                    "name" => $product->name,
                    "description" => $product->description,
                    "quantity" => 1,
                    "price" => $product->sale_price,
                    "photo" => $product->productimg
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', "producto agregado!");
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', "producto agregado!");

        }

        $cart[$id] = [
            "id" => $product->id,
            "name" => $product->name,
            "description" => $product->description,
            "quantity" => 1,
            "price" => $product->sale_price,
            "photo" => $product->productimg
        ];

        session()->put('cart', $cart);


        return redirect()->back()->with('success', "producto agregado!");

    }



    public function delete($id)
    {
        $product = session::forget('cart', $id)->first();
        $product->destroy($id);
        return redirect()->back();
    }

    public function update(Product $product, Request $request)
    {
        $this->validate($request, [
            'sale_price' => 'required',

        ]);

        DB::Table('products')->where('id', $product->id)->update(
            array(
                'sale_price' => $request->get('sale_price'),

            )
        );

        return redirect()->route('cart');
    }

}
