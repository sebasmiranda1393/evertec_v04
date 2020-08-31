<?php namespace App\Http\Controllers;

use App\Product;
use App\User;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $value = $request->user()->authorizeRoles(['user', 'admin']);
        $users = User::all();

        if ($value) {
            return view('home', ["users" => $users]);

        } else {
            $products = DB::table('products')->where('status', true)->paginate(4);
            return view('customer/homeCustomer', ['products' => $products]);
        }
    }

    public function indexejemplo()
    {
        $products = DB::table('products')->where('status', true)->paginate(4);
        return view('customer/homeCustomer', ['products' => $products]);
    }

    public function home()
{
    $products = DB::table('products')->where('status', true)->paginate(4);
    return view('customer/homeCustomer', ['products' => $products]);
}


}
