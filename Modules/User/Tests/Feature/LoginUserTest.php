<?php

namespace User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use User\Data\Models\User;

class LoginUserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $endpoint = "/api/login";

    public function test_user_can_get_access_token(): void
    {
        $data = $this->getUserData();

        $response = $this->postJson($this->endpoint, [
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
        ]);
        $token = $response->json('access_token');
        $this->assertNotEmpty($token);
    }

    public function test_user_cannot_login_with_wrong_password(): void
    {
        $data = $this->getUserData();

        $response = $this->postJson($this->endpoint, [
            'email' => $data['email'],
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(401);
    }

    public function test_access_token_is_valid(): void
    {
        $data = $this->getUserData();

        $response = $this->postJson($this->endpoint, [
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $token = $response->json('access_token');
        $protectedResponse = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/user');
        $protectedResponse->assertStatus(200);
    }

    private function getUserData(): array
    {
        $password = $this->faker->password;
        $data =  [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $password,
            'password_confirmation' => $password,
        ];
        User::factory()->create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => $data['password'],
        ]);
        return $data;
    }
}
