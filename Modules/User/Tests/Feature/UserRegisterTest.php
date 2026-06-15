<?php

namespace User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use User\Tasks\CreateUserTask;

class UserRegisterTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $endpoint = "/api/register";

    public function test_new_user_can_register(): void
    {
        $data = $this->getRegisterData();

        $response = $this->postJson($this->endpoint, $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
            'name' => $data['name'],
        ]);
        $response->assertExactJson([
            'message' => 'Registration is successfully done.',
        ]);
    }

    public function test_user_cannot_register_already_exists(): void
    {
        $data = $this->getRegisterData();
        CreateUserTask::new()->run([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => $data['password'],
        ]);

        $response = $this->postJson($this->endpoint, $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'email',
        ]);
        $response->assertJsonPath(
            'errors.email.0',
            'The email has already been taken.'
        );
    }

    private function getRegisterData(): array
    {
        $password = $this->faker->password(8);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $password,
            'password_confirmation' => $password,
        ];
    }
}
