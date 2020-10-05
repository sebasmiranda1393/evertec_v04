<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart/cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        var_dump("entro_create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        var_dump("entro_store");
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        var_dump("entro_edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        var_dump("entro_update");
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function empty(int $idProduct)
    {
        var_dump("entro a empty");
        $cart = session()->get('cart');
        if ($cart!=null) {
            foreach ($cart as $key => $value) {
                $this->updateQuantityProductByDeleteProductOfCar($value["id"], $value['quantity']);
            }
            Session::pull('cart');
        }
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

}
