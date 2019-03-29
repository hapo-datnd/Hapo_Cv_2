<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->post('/login',
            [
                'email' => 'dat@gmail.com',
                'password' => 'anhemvoinhau'
                ]);

        $response->assertRedirect('/home');
    }
}
