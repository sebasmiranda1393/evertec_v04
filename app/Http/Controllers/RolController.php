<?php

namespace App\Http\Controllers;

use App\CartProduct;
use App\Exports\ArchivoPrimarioExport;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
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
}
