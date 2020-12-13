<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();*/

        $user = new User();
        $user->name = 'erika';
        $user->email = 'ingerika.forero@gmail.com';
        $user->password = bcrypt('12345678');
       // $user->role_id = (2);
        $user->save();


        $user = new User();
        $user->name = 'sebas';
        $user->email = 'sebasmirandadc@gmail.com';
        $user->password = bcrypt('12345678');
       // $user->role_id = (1);
        $user->save();

    }
}
