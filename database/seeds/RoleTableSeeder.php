<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new \Spatie\Permission\Models\Role();
        $role->name = 'Usuario';
        $role->guard_name = 'web';
        $role->save();

        $role = new \Spatie\Permission\Models\Role();
        $role->name = 'Administrador';
        $role->guard_name = 'web';
        $role->save();
    }
}
