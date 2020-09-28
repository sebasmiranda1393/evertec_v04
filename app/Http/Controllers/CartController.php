<?php namespace App\Http\Controllers;

use App\Cart;
use App\CartProduct;
use App\Product;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function cart()
    {
        return view('cart/cart');
    }


    public function saveCart()
    {
        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->save();

        foreach (session()->get('cart') as $key => $value) {
            $cartDetails = new CartProduct();
            $cartDetails->cart_id = $cart->id;
            $cartDetails->product_id = $value["id"];
            $cartDetails->quantity = $value["quantity"];
            $cartDetails->save();
        }
        $this->emptyCar();
        return redirect()->back();
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


            toastr()->success('producto agregado');

            return redirect()->back()->with('success', "producto agregado!");
        }


        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            toastr()->success('producto agregado');

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
        toastr()->success('producto agregado');
        return redirect()->back()->with('success', "producto agregado!");

    }


    public function delete(int $idProduct)
    {
        $cart = session()->get('cart');
        foreach ($cart as $key => $value) {
            if ($idProduct == $value["id"]) {
                Session::pull('cart.' . $key);
                break;
            }

        }
        return redirect()->back();
    }


    public function emptyCar()
    {
        Session::pull('cart');
        return redirect()->back();
    }

    public function increaseProduct(int $idProduct)
    {
        $this->commonOperations($idProduct, 'sum');
        return redirect()->back();
    }

    public function decreaseProduct(int $idProduct)
    {
        $this->commonOperations($idProduct, 'res');
        return redirect()->back();

    }

    public function commonOperations(int $idProduct, string $operations)
    {

        $cart = session()->get('cart');
        if ($operations == 'sum') {
            $cart[$idProduct]['quantity']++;

        } else {
            if ($cart[$idProduct]['quantity']==1){

            }else {
                $cart[$idProduct]['quantity']--;
            }
        }
        session()->put('cart', $cart);

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
