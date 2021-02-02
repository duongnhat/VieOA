<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function testRequiredAllFieldsForLogin()
    {
        $this->json('POST', 'api/login', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "Login failed.",
                "error_code" => 1,
                "errors" => [
                    "username" => ["The username field is required."],
                    "password" => ["The password field is required."],
                ]
            ]);
    }

    public function testRequiredUserNameFieldsForLogin()
    {
        $loginData = [
            "password" => "demo12345"
        ];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "Login failed.",
                "error_code" => 1,
                "errors" => [
                    "username" => ["The username field is required."],
                ]
            ]);
    }

    public function testRequiredPasswordFieldsForLogin()
    {
        $loginData = [
            "username" => "demo12345"
        ];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "Login failed.",
                "error_code" => 1,
                "errors" => [
                    "password" => ["The password field is required."],
                ]
            ]);
    }

    public function testIncorrectPasswordForLogin()
    {
        $loginData = [
            "username" => "demo12345",
            "password" => "demo123456"
        ];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "Login failed.",
                "error_code" => 1,
                "errors" => [
                    "password" => ["Username or password is wrong."],
                ]
            ]);
    }

    public function testUsernameNotExistForLogin()
    {
        $loginData = [
            "username" => "username_not_exist",
            "password" => "demo123456"
        ];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "Login failed.",
                "error_code" => 1,
                "errors" => [
                    "username" => ["Username or password is wrong."],
                ]
            ]);
    }

    public function testSuccessfulForLogin()
    {
        $loginData = [
            "username" => "demo12345",
            "password" => "demo12345"
        ];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "error_code",
                "user" => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
                "access_token",
                "message"
            ]);
    }
}
