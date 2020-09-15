<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $value = $request->user()->authorizeRoles(['user', 'admin']);
        $users = User::all();

        if ($value) {
            return view('home', ["users" => $users]);

        } else {
            $products = DB::table('products')->where('status', true)->paginate(4);
            return view('admin/home_admin', ['products' => $products]);
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $products = DB::table('products')->where('status', true)->paginate(4);
        return view('admin/home_admin', ['products' => $products]);
    }


    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $user = User::find($user->id);
        return view('edit', ["user" => $user]);
    }


    /**
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'status' => 'required'
        ]);

        DB::Table('users')->where('id', $user->id)->update(
            array(
                'status' => $request->get('status'),
                'name' => $request->get('name'),
                'email' => $request->get('email')
            )
        );


        return redirect()->route('home');
    }

    public function back()
    {
        return redirect()->route('home');
    }

    public function search(Request $request, int $id)
    {
        $namesearch = $request->get('namesearch');
        $valorsearch = $request->get('valorsearch');
        $products = DB::Table('products')->where('name', 'like', '%' . $namesearch . '%')
            ->where('sale_price', 'like', '%' . $valorsearch . '%')
            ->where('status', true)->paginate(4);

        if ($id == 0) {
            return view('admin/home_admin', ["products" => $products]);

        } else {
            return view('admin/home_admin', ["products" => $products]);
        }
    }

    public function welcome()
    {
        $products = DB::table('products')->where('status', true)->paginate(4);
        return view('admin/home_admin', ['products' => $products]);
    }
}
