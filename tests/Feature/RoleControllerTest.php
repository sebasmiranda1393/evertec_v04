<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{

    public function testRolCreatedSuccessfully()
    {

        $role = new Role([
            'name' => "Naranja",
            'guard_name' => "web",
            'created_at' => now(),
            'created_at' => now(),

        ]);
        $this->assertEquals(null, $role->name);

    }
}
