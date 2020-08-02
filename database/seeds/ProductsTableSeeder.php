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
        App\Product::create(['name' => 'Leche','description' => 'Leche entera', 'purchase_price' => 2300.0,
            'sale_price' => 2300.0, 'available' => 2,'category_id' => 2]);

        App\Product::create(['name' => 'Agua','description' => 'Agua entera', 'purchase_price' => 1300.0,
            'sale_price' => 2300.0, 'available' => 2,'category_id' => 2]);

    }
}
