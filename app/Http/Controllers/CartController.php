<?php

namespace App\Http\Controllers;

use App\Services\Auth\AuthRequest;
use App\Cart;
use App\CartProduct;
use App\Services\Payment\Amount;
use App\Services\Payment\PaymentRequest;
use App\Services\Request\RedirectRequest;
use Illuminate\Http\RedirectResponse;
use App\utils\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{

    protected $cartController;

    public function __construct(OrderController $cartController)
    {
        $this->middleware('auth');
        $this->cartController = $cartController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     //   if (session()->get('cart') != null) {
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

            $reference = 'TEST_' . time();
            $request = [
                "locale" => "es_CO",
                "payer" => [
                    "name" => "Erika",
                    "surname" => "orero",
                    "email" => "ingerika.forero@gmail.com",
                    "documentType" => "CC",
                    "document" => "1848839248",
                    "mobile" => "3006108300",
                    "address" => [
                        "street" => "703 Dicki Island Apt. 609",
                        "city" => "North Randallstad",
                        "state" => "Antioquia",
                        "postalCode" => "46292",
                        "country" => "US",
                        "phone" => "363-547-1441 x383"
                    ]
                ],
                "payment" => [
                    "reference" => $reference,
                    "description" => "Iusto sit et voluptatem.",
                    "amount" => [
                        "currency"=> "COP",
                        "total"=> $amount
                    ],
                    "buyer" => [
                        "name" => "Sebastian",
                        "surname" => "Miranda Hernandez",
                        "email" => "sebasmirandadc@gmail.com",
                        "documentType" => "CC",
                        "document" => "1073165535",
                        "mobile" => "3144452921"
                    ],
                    "allowPartial" => false
                ],
                "expiration" => date('c', strtotime('+2 hour')),
                "ipAddress" => "127.0.0.1",
                "userAgent" => "PlacetoPay Sandbox",
                "returnUrl" => "https://www.google.com/"
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
         //   var_dump(config('placetopay.url'));
          return  redirect($response->processUrl() );

        //$this->cartController->empty(0);

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
            'products.sale_price', 'cart_products.quantity')
            ->join('cart_products', 'carts.id', '=', 'cart_products.cart_id')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->join('products', 'products.id', '=', 'cart_products.product_id')
            ->where('carts.user_id', Auth::user()->id)
            ->where('carts.id', $id)
            ->get();

        return view('cart/my_carts', ['carts' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
