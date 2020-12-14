<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\User;

use Tests\TestCase;

class UserControllerTest extends TestCase
{

    public function testUserCreatedSuccessfully()
    {
            $user = new User([
                'name' => "Test User",
                'email' => "test@mail.com",
                'password' => bcrypt("testpassword")
            ]);

            $this->assertEquals('Test User', $user->name);

    }
}


