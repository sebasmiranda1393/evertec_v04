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
            'sale_price' => 2300.0,'productimg' => "leche alqueria 1578438734894.png" ,'available' => 2,'category_id' => 2]);

        App\Product::create(['name' => 'Agua','description' => 'Agua', 'purchase_price' => 1300.0,
            'sale_price' => 2300.0, 'productimg' => "aguacristal585755888.png",'available' => 2,'category_id' => 2]);

        App\Product::create(['name' => 'azucar','description' => 'azucar blanca', 'purchase_price' => 1000.00,
            'sale_price' => 1000.00,'productimg' => "azucar1596412419.jpg" ,'available' => 2,'category_id' => 2]);

        App\Product::create(['name' => 'leche condensada','description' => 'leche condensada nestle', 'purchase_price' => 1300.0,
            'sale_price' => 2300.0, 'productimg' => "leche condensada1596412477.jpeg",'available' => 2,'category_id' => 2]);

        App\Product::create(['name' => 'jabon liquido','description' => 'Jabon liquido palmolive', 'purchase_price' => 4300.0,
            'sale_price' => 7300.0,'productimg' => "jabon liquido1596421475.png" ,'available' => 12,'category_id' => 2]);

        App\Product::create(['name' => 'panela','description' => 'Panela cuadrada', 'purchase_price' => 2300.0,
            'sale_price' => 6300.0, 'productimg' => "panela1596421508.png",'available' => 22,'category_id' => 2]);

        App\Product::create(['name' => 'arroz','description' => 'arroz diana', 'purchase_price' => 8300.0,
            'sale_price' => 9300.0,'productimg' => "arroz1596421550.png" ,'available' => 2,'category_id' => 2]);

        App\Product::create(['name' => 'toalla higuienica','description' => 'toallas nosotras', 'purchase_price' => 9300.0,
            'sale_price' => 23000.0, 'productimg' => "toalla higuienica1596421625.png",'available' => 2,'category_id' => 2]);

        App\Product::create(['name' => 'frijol','description' => 'frijol rojo', 'purchase_price' => 5300.0,
            'sale_price' => 7300.0,'productimg' => "frijol1596421649.png" ,'available' => 2,'category_id' => 2]);

        App\Product::create(['name' => 'queso','description' => 'queso parmesano alpina', 'purchase_price' => 6300.0,
            'sale_price' => 21300.0, 'productimg' => "quesoparmesanoalpina7484848.png",'available' => 2,'category_id' => 2]);

    }
}
