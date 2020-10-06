<?php

namespace App\Http\Controllers;

use App\Services\Auth\AuthRequest;
use App\Cart;
use App\CartProduct;
use App\Services\Payment\Amount;
use App\Services\Payment\PaymentRequest;
use App\Services\Request\RedirectRequest;
use App\Services\Response\RedirectResponse;
use App\utils\Constants;
use Illuminate\Http\Request;
//use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
            $this->cartController->empty(0);
            //  return redirect()->back();
        } else {
          //  return redirect()->back();
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


    public function loadRedirectRequest($amount)
    {
        $auth = new AuthRequest();
        $auth->setLogin(Constants::LOGIN);
        $auth->setNonce();
        $auth->setSeed(date('c'));
        $auth->setTranKey(Constants::SECRET_KEY);
        var_dump($auth);

        $amountRequest = new Amount();
        $amountRequest->setCurrency('COP');
        $amountRequest->setTotal($amount);

        $paymentRequest = new PaymentRequest();
        $paymentRequest->setReference('5976030f5575d');
        $paymentRequest->setDescription('Pago básico de prueba');
        $paymentRequest->setAmount($amountRequest);

        $redirectRequest = new RedirectRequest();
        $redirectRequest->setAuth($auth);
        $redirectRequest->setPayment($paymentRequest);

        $redirectRequest->setExpiration(date('Y-m-d H:i:s', time()));
        $redirectRequest->setReturnUrl('http://127.0.0.1:8000/home?page=3');
        $redirectRequest->setIpAddress('27.0.0.1');
        $redirectRequest->setUserAgent('PlacetoPay Sandbox');

        $request_c = [
            "auth" => [
                "login" => Constants::LOGIN,
                "tranKey" => $auth->getTranKey(),
                "nonce" => $auth->getNonce(),
                "seed" => $auth->getSeed()
            ],
            'payment' => [
                'reference' => $paymentRequest->getReference(),
                'description' => $paymentRequest->getDescription(),
                'amount' => [
                    'currency' => 'COP',
                    'total' => $amountRequest->getTotal(),
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'ipAddress' => $redirectRequest->getIpAddress(),
            'userAgent' => $redirectRequest->getUserAgent(),
            'returnUrl' => $redirectRequest->getReturnUrl(),
        ];

        $redirectResponse = new RedirectResponse();
        $redirectResponse = Http::post('https://test.placetopay.com/redirection', $request_c);
        echo('-----------------------------------------------------\n');

        var_dump($redirectResponse->body());

    }
}
