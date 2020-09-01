<?php namespace App\Http\Controllers;

use App\Post;
use App\User;
use DB;

use Illuminate\Http\Request;

use Session;

class CustomerController extends Controller
{

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

    Session::flash('success_msg', 'Post updated successfully!');

    return redirect()->route('home');
}

    public function back()
    {
        return redirect()->route('home');
    }
}
