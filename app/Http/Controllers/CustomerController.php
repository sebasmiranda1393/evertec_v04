<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    /**
     * CustomerController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @param int $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $user = User::find($id);
        //  return view('admin/home_admin', ["products" => $products]);
        return view('customer/customer_edit', ["user" => $user]);
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

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function back(): view
    {
        return redirect()->route('home');
    }
}
