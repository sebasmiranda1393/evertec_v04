<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->middleware([
            'auth'
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('cart/cart');
    }



    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
            } else {
                toastr()->warning('producto no agregado');
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
                toastr()->warning('producto no agregado');
            }
            return redirect()->back()->with('success');
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
            toastr()->warning('producto no agregado');
        }
        return redirect()->back()->with('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $cart = session()->get('cart');
        foreach ($cart as $key => $value) {
            if ($id == $value["id"]) {
                $this->updateQuantityProductByDeleteProductOfCar($id, $value['quantity']);
                Session::pull('cart.' . $key);
                break;
            }
        }

        toastr()->success('producto eliminado');
        return redirect()->back()->with('success');
    }

    public function updateQuantityProductByDecrement(int $idProduct, int $quantity)
    {
        $quantity--;
        DB::Table('products')->where('id', $idProduct)->update(
            array(
                'available' => $quantity
            )
        );
    }

    public function updateQuantityProductByIncrement(int $idProduct, int $quantity)
    {
        $quantity++;
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
            if ($product->available == 0) {
                toastr()->warning('No hay mas existencias del producto');
            } else {
                $this->updateQuantityProductByDecrement($product->id, $product->available);
                $cart[$idProduct]['quantity']++;
                toastr()->success('producto agregado');
            }
        } else {
            if ($cart[$idProduct]['quantity'] == 1) {
                toastr()->warning('No hay mas existencias del producto');
            } else {
                $this->updateQuantityProductByIncrement($product->id, $product->available);
                $cart[$idProduct]['quantity']--;
                toastr()->warning('has quitado una unidad de este producto');
            }
        }
        session()->put('cart', $cart);

    }

    public function updateQuantityProductByDeleteProductOfCar(int $idProduct, int $quantity)
    {
        $product = Product::find($idProduct);
        $quantity = $quantity + $product->available;
        DB::Table('products')->where('id', $idProduct)->update(
            array(
                'available' => $quantity
            )
        );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function empty(int $idProduct)
    {
        if ($idProduct == 0) {
            Session::pull('cart');
            return redirect()->back();
        }
        $cart = session()->get('cart');
        if ($cart != null) {
            foreach ($cart as $key => $value) {
                $this->updateQuantityProductByDeleteProductOfCar($value["id"], $value['quantity']);
            }
            Session::pull('cart');
        }
        return redirect()->back();
    }

    public function buyNow(int $idOrder)
    {


        $data = Cart::select('carts.id', 'carts.created_at', 'products.name', 'products.id', 'products.productimg',
            'products.sale_price', 'cart_products.quantity', 'carts.request_id' )
            ->join('cart_products', 'carts.id', '=', 'cart_products.cart_id')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->join('products', 'products.id', '=', 'cart_products.product_id')
            ->where('carts.user_id', Auth::user()->id)
            ->where('carts.id', $idOrder+1)
            ->get();

        return view('cart/cart_renow', ["carts" => $data]);
    }



}

