<?php

use Illuminate\Database\Seeder;


class CartsTableSeeder extends Seeder
{


    public function run()
    {
        App\Cart::create(['id' =>'1']);

    }
}
