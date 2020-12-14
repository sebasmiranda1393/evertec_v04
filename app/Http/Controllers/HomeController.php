<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {

     $user = User::find(Auth::user()->id);
        $data = User::select('users.id','users.name as nombre','users.email', 'users.status','users.created_at' , 'users.updated_at','roles.name')
            ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->leftjoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->get();
        if ($user->hasRole('Administrador')) {
            return view('admin/home', ["users" => $data]);
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
