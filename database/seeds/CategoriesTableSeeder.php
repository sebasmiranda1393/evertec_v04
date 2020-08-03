<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Category::create(['category' =>'Fruta']);
        App\Category::create(['category' =>'Bebida']);
    }
}
