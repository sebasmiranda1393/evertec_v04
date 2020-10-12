<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = DB::table('products')->where('status', true)->paginate(4);
        return view('admin/home_admin', ['products' => $products]);
    }

}
