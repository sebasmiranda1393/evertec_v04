<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $value = $request->user()->authorizeRoles([$user->role_id]);
        $users = User::all();

        if ($value) {
            return view('admin/home', ["users" => $users]);
        } else {
            $products = DB::table('products')->where('status', true)->paginate(4);
            return view('customer/customer_home', ['products' => $products]);
        }
    }

    /**
     * @return Application|Factory|View
     */
    public function home()
    {
        $products = DB::table('products')->where('status', true)->paginate(4);
        return view('customer/customer_home', ['products' => $products]);
    }
}
