<?php

namespace App\Http\Controllers;

use App\Models\placetopay\request\Amount;
use App\AuthRequest;
use App\Cart;
use App\CartProduct;
use App\PaymentRequest;
use App\Product;
use App\RedirectRequest;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cart()
    {
        return view('cart/cart');
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveCart()
    {
        if (session()->get('cart') != null) {
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->save();
            $amount = 0;
            foreach (session()->get('cart') as $key => $value) {
                $amount += $value['price'] * $value['quantity'];
                $cartDetails = new CartProduct();
                $cartDetails->cart_id = $cart->id;
                $cartDetails->product_id = $value["id"];
                $cartDetails->quantity = $value["quantity"];
                $cartDetails->save();
            }
            $this->loadRedirectRequest($amount);
            $this->emptyCar();
            // return redirect()->back();
        } else {
            return redirect()->back();
        }

    }


    public function loadRedirectRequest($amount)
    {
        //$amountRequest = new Amount('COP',$amount);
        $auth = new AuthRequest();
        /* $auth->login = '6dd490faf9cb87a9862245da41170ff2';
         $auth->tranKey = 'jsHJzM3+XG754wXh+aBvi70D9/4=';
         $auth->nonce = 'TTJSa05UVmtNR000TlRrM1pqQTRNV1EREprWkRVMU9EZz0=';
         $auth->seed = date('c');*/
        $amountRequest = new Amount();
        $amountRequest->currency = 'COP';
        $amountRequest->total = $amount;
        $paymentRequest = new PaymentRequest();
        $paymentRequest->reference = '5976030f5575d';
        $paymentRequest->description = 'Pago básico de prueba';
        $paymentRequest->amount = $amountRequest;
        $redirectRequest = new RedirectRequest();
        $redirectRequest->auth = $auth;
        $redirectRequest->payment = $paymentRequest;

        $redirectRequest->expiration = date('Y-m-d H:i:s', time());
        $redirectRequest->returnUrl = 'https://dev.placetopay.com/redirection/sandbox/session/5976030f5575d';
        $redirectRequest->ipAddress = '27.0.0.1';
        $redirectRequest->userAgent = 'PlacetoPay Sandbox';
        echo($redirectRequest);


    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart($id)
    {
        $product = Product::find($id);
        if (!$product) {

            abort(404);

        }
        $cart = session()->get('cart');

        if (!$cart) {
            if ($product->available > 0) {
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

                $this->updateQuantityProductByDecrement($id, $product->available);
                session()->put('cart', $cart);
                toastr()->success('producto agregado');
                return redirect()->back()->with('success');
            }else{
                toastr()->success('producto no agregado');
                return redirect()->back()->with('success');
            }
        }


        if (isset($cart[$id])) {

            if ($product->available > 0) {
                $cart[$id]['quantity']++;
                $this->updateQuantityProductByDecrement($id, $product->available);
                session()->put('cart', $cart);
                toastr()->success('producto agregado');
                return redirect()->back()->with('success');
            } else {
                toastr()->success('producto no agregado');
            }
        }

        if ($product->available > 0) {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "description" => $product->description,
                "quantity" => 1,
                "price" => $product->sale_price,
                "photo" => $product->productimg
            ];
            session()->put('cart', $cart);
            $this->updateQuantityProductByDecrement($id, $product->available);
            toastr()->success('producto agregado');
            return redirect()->back()->with('success');
        } else {
            toastr()->success('producto no agregado');
        }
        return redirect()->back()->with('success');
    }


    public function updateQuantityProductByDecrement(int $idProduct, int $quantity)
    {
        $quantity --;
        DB::Table('products')->where('id', $idProduct)->update(
            array(
                'available' => $quantity
            )
        );
    }

    /*public function updateQuantityProductByDecrement(int $idProduct, int $quantity)
    {
        $quantity --;
        DB::Table('products')->where('id', $idProduct)->update(
            array(
                'available' => $quantity
            )
        );
    }*/


    public function updateQuantityProductByIncrement(int $idProduct, int $quantity)
    {
        $quantity ++;
        DB::Table('products')->where('id', $idProduct)->update(
            array(
                'available' => $quantity
            )
        );
    }

    /**
     * @param int $idProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(int $idProduct)
    {
        $product = Product::find($idProduct);
        $cart[$idProduct]['quantity'];

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


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function emptyCar()
    {

        Session::pull('cart');
        return redirect()->back();
    }

    /**
     * @param int $idProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function increaseProduct(int $idProduct)
    {
        $this->commonOperations($idProduct, 'sum');
        return redirect()->back();
    }

    /**
     * @param int $idProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function decreaseProduct(int $idProduct)
    {
        $this->commonOperations($idProduct, 'res');
        return redirect()->back();

    }

    /**
     * @param int $idProduct
     * @param string $operations
     */
    public function commonOperations(int $idProduct, string $operations)
    {
        $product = Product::find($idProduct);
        var_dump("entro");
        $cart = session()->get('cart');
        if ($operations == 'sum') {
            if ($product->available ==0) {
            } else {
                $this->updateQuantityProductByDecrement($product->id, $product->available);
                $cart[$idProduct]['quantity']++;
            }
        } else {
            if ($cart[$idProduct]['quantity'] == 1) {

            } else {
                $this->updateQuantityProductByIncrement($product->id, $product->available);
                $cart[$idProduct]['quantity']--;
            }
        }
        session()->put('cart', $cart);

    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * @param int $idCart
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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


    /**
     * @param Product $product
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
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
