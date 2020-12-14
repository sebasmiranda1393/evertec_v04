<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    public function testProductCreatedSuccessfully()
    {
        $product = new Product([
            'name' => "Naranja",
            'description' => "Naranja Tangelo",
            'purchase_price' => "6000",
            'sale_price' => "70000",
            'available' => "2",
            'status' => "1",
            'category_id' => "1",
            'created_at' => now(),
            'created_at' => now(),

        ]);

        $this->assertEquals('Naranja', $product->name);

    }
}
