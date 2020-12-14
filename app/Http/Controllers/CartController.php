<?php

namespace App\Http\Controllers;

use App\Services\Auth\AuthRequest;
use App\Cart;
use App\CartProduct;
use App\Services\Payment\Amount;
use App\Services\Payment\PaymentRequest;
use App\Services\Request\RedirectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Dnetix\Redirection\PlacetoPay;


class CartController extends Controller
{
    protected $cartController;


    /**
     * CartController constructor.
     * @param OrderController $cartController
     */
    public function __construct(OrderController $cartController)    {

        $this->cartController = $cartController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Cart::select('carts.id', 'carts.created_at','carts.request_id' , DB::raw('sum(products.sale_price) as total'))
            ->join('cart_products', 'carts.id', '=', 'cart_products.cart_id')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->join('products', 'products.id', '=', 'cart_products.product_id')
            ->where('carts.user_id', Auth::user()->id)
            ->groupBy('carts.id')
            ->get();

        return view('cart/list_carts', ["carts" => $data]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $amount = 0;
        if (session()->get('cart') != null) {
            foreach (session()->get('cart') as $key => $value) {
                $amount += $value['price'] * $value['quantity'];
            }
            $reference = 'TEST_' . time();
            $request = [
                "locale" => config('locale'),
                "payer" => [
                    "name" => Auth::user()->name,
                    "surname" => "Forero",
                    "email" => Auth::user()->email,
                    "documentType" => "CC",
                    "document" => "1848839248"
                ],
                "payment" => [
                    "reference" => $reference,
                    "description" => config('description'),
                    "amount" => [
                        "currency" => "COP",
                        "total" => $amount
                    ]
                ],
                "expiration" => date('c', strtotime('+2 hour')),
                "ipAddress" => "127.0.0.1",
                "userAgent" => "PlacetoPay Sandbox",
                "returnUrl" => "http://127.0.0.1:8000/home"
            ];
            $placetopay = new PlacetoPay([
                'login' => config('placetopay.login'),
                'tranKey' => config('placetopay.trankey'),
                'url' => config('placetopay.url'),
                'type' => config('placetopay.type'),
                'rest' => [
                    'timeout' => 45, // (optional) 15 by default
                    'connect_timeout' => 30, // (optional) 5 by default
                ]
            ]);
            $response = $placetopay->request($request);
            if ($response->isSuccessful()) {

                $cart = new Cart();
                $cart->user_id = Auth::user()->id;
                $cart->request_id = $response->requestId();
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

                $this->cartController->empty(0);

                return redirect($response->processUrl());
            } else {
                toastr()->info('No se pudo redireccionar a la pasarela de pagos!');
                return redirect()->back();
            }
        } else {
            toastr()->info('Por favor agregue articulos a su carrito!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Cart::select('carts.id', 'carts.created_at', 'products.name', 'products.id', 'products.productimg',
            'products.sale_price', 'cart_products.quantity', 'carts.request_id' )
            ->join('cart_products', 'carts.id', '=', 'cart_products.cart_id')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->join('products', 'products.id', '=', 'cart_products.product_id')
            ->where('carts.user_id', Auth::user()->id)
            ->where('carts.id', $id)
            ->get();

        $requestId = 0;
        foreach($data as $id => $details){
            $requestId = $details['request_id'];
        }

        $placetopay = new PlacetoPay([
            'login' => config('placetopay.login'),
            'tranKey' => config('placetopay.trankey'),
            'url' => config('placetopay.url'),
            'type' => config('placetopay.type'),
            'rest' => [
                'timeout' => 45, // (optional) 15 by default
                'connect_timeout' => 30, // (optional) 5 by default
            ]
        ]);

        $response = $placetopay->query($requestId);
         return view('cart/my_carts', ['carts' => $data],  ['status' => $response->status()], ['id'=>$id]);
    }

}
