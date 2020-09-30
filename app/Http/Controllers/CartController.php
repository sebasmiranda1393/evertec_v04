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

            return redirect()->back()->with('success');
        }


        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            toastr()->success('producto agregado');

            return redirect()->back()->with('success');

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
        return redirect()->back()->with('success');

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

        toastr()->success('producto eliminado');
        return redirect()->back()->with('success');;
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
            if ($cart[$idProduct]['quantity'] == 1) {

            } else {
                $cart[$idProduct]['quantity']--;
            }
        }
        session()->put('cart', $cart);

    }


    public function listCarts()
    {
        $data = Cart::select('carts.id', 'carts.created_at', DB::raw('sum(products.sale_price) as total'))
            ->join('cart_products', 'carts.id', '=', 'cart_products.cart_id')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->join('products', 'products.id', '=', 'cart_products.product_id')
            ->where('carts.user_id', Auth::user()->id)
            ->groupBy('carts.id')
            ->get();

        return view('cart/list_carts', ["carts" => $data]);

    }

    public function myCarts(int $idCart)
    {
        $data = Cart::select('carts.id', 'carts.created_at', 'products.name', 'products.id', 'products.productimg',
            'products.sale_price', 'cart_products.quantity')
            ->join('cart_products', 'carts.id', '=', 'cart_products.cart_id')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->join('products', 'products.id', '=', 'cart_products.product_id')
            ->where('carts.user_id', Auth::user()->id)
            ->where('carts.id', $idCart)
            ->get();

        return view('cart/my_carts', ['carts' => $data]);

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
