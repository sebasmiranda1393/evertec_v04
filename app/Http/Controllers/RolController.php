<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolController extends Controller
{
    public function rol()
    {
        return view('employees/rol');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = DB::table('roles')->get();

        return view('employees/rol', ['roles' => $roles]);
    }

    public function show(int $id)
    {
        $data= Permission::select('permissions.id','permissions.name')
            ->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->join('roles', 'role_has_permissions.role_id', '=', 'roles.id')
            ->where('roles.id', $id)
            ->get();

        return view('employees/permissions_roles', ['permissions' => $data]);
    }


    public function edit(int $id)
    {
        $role =  Role::findById($id);
        $permissions = DB::table('permissions')->get();
        return view('employees/rol_edit', ['rol' => $role], ['permissions' => $permissions]);
    }


    public function update(int $id, Request $request)
    {
       $rol = Role::findById($id);
       $rol->givePermissionTo($request->get('permisos'));
        $roles = DB::table('roles')->get();
        return view('employees/rol', ['roles' => $roles]);


    }
}
