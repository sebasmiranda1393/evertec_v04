<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permission list to Administrador
        Permission::create(['name' => 'product.edit']);
        Permission::create(['name' => 'reports']);
        Permission::create(['name' => 'role.edit']);

        //Admin
        $admin = Role::findByName("Administrador");

        $admin->givePermissionTo([
            'product.edit',
            'reports',
            'role.edit'
        ]);
        //$admin->givePermissionTo('products.index');
        //$admin->givePermissionTo(Permission::all());

        //Permission list to usuario
        Permission::create(['name' => 'cart.index']);
        Permission::create(['name' => 'order']);

        //user
        $user = Role::findByName("Usuario");

        $user->givePermissionTo([
            'cart.index',
            'order'

        ]);

    }
}
