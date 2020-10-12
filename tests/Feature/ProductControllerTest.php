<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get(route('product.index'));
        $response->assertStatus(302);
        $response->assertViewIs('product.product');
    }
}
