<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthAPITest extends TestCase
{
    public function testAuthAPILoginMethod()
    {
        $user = factory(User::class)->create();
        $response = $this->postJson('/api/user/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
                'is_author',
                'notifications',
            ],
            'access_token'
        ]);
    }

    public function testAuthAPILoginMethodValidation()
    {
        $response = $this->postJson('/api/user/login', [
            'email' => 'randomemail@gmail.com',
            'password' => mt_rand(0,100),
        ])->assertJsonStructure([
            'status'
        ]);
    }

    public function testAuthAPIRegisterMethod()
    {
        $response = $this->postJson('/api/user/register', [
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'is_author' => true,
            'notifications' => false,
        ])->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
                'is_author',
                'notifications',
            ],
            'access_token'
        ]);
    }

    public function testAuthAPIRegisterMethodValidation()
    {
        $response = $this->postJson('/api/user/register', [
            'name' => '',
            'email' => 'invalid email',
            'password' => 'password',
            'password_confirmation' => 'password',
            'is_author' => true,
            'notifications' => false,
        ])->assertJsonStructure([
            'errors' => [
                'name',
                'email',
            ]
        ]);
    }
}
