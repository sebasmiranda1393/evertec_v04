<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller{

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
        $value= $request->user()->authorizeRoles(['user', 'admin']);
        $users = User::all();
       if($value)
       {
           return view('home',["users"=>$users]);
       }
       else
           {
               return view('prueba',["users"=>$users]);
           }


    }

    /*public function someAdminStuff(Request $request) {
        $request->user()->authorizeRoles('admin');
        return view('some.view');
    }*/
    }
