<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Product::create(['product' => 'Leche','description' => 'Leche entera', 'price' => 2300.0,'category_id' => 2]);
        App\Product::create(['product' => 'Agua','description' => 'Agua entera', 'price' => 1300.0,'category_id' => 2]);

    }
}
