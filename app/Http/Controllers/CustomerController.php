<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;


class CustomerController extends Controller
{
    /**
     * @param int $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $user = User::find($id);

        $roles = DB::table('roles')->get();
        return view('customer/customer_edit', ["user" => $user],["roles" => $roles]);
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
            'status' => 'required',
            'rol' => 'required'
        ]);

        DB::Table('users')->where('id', $user->id)->update(
            array(
                'status' => $request->get('status'),
                'name' => $request->get('name'),
                'email' => $request->get('email')
            )
        );
        $rolesUserName = $user->getRoleNames();
        $rol=Role::findByName($rolesUserName[0]);

        $user->removeRole($rol);
        $user->assignRole($request->get('rol'));
        $data = User::select('users.id','users.name as nombre','users.email', 'users.status','users.created_at' , 'users.updated_at','roles.name')
            ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->leftjoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->get();
        return view('admin/home', ["users" => $data]);

    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function back()
    {
        $data = User::select('users.id','users.name as nombre','users.email', 'users.status','users.created_at' , 'users.updated_at','roles.name')
            ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->leftjoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->get();
        return view('admin/home', ["users" => $data]);

    }


}
