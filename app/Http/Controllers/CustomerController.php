<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    /**
     * @param int $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $user = User::find($id);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function back()
    {
        return view('customer/customer_home', ['products' => $products]);
    }
}
