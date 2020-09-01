<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use DB;


class CartController extends Controller
{
    public function update(Product $product, Request $request)
    {
    }
}
