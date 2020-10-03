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
    public function home()
    {
        $products = DB::table('products')->where('status', true)->paginate(4);
        return view('admin/home_admin', ['products' => $products]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
        $products = DB::table('products')->where('status', true)->paginate(4);
        return view('admin/home_admin', ['products' => $products]);
    }

    public function search(Request $request, int $id)
    {
        $namesearch = $request->get('namesearch');
        $valorsearch = $request->get('valorsearch');
        $products = \Illuminate\Support\Facades\DB::Table('products')->where('name', 'like', '%' . $namesearch . '%')
            ->where('sale_price', 'like', '%' . $valorsearch . '%')
            ->where('status', true)->paginate(4);

        if ($id == 0) {
            return view('admin/home_admin', ["products" => $products]);

        } else {
            return view('admin/home_admin', ["products" => $products]);
        }
    }
}
