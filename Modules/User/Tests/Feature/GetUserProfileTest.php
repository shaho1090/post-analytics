<?php

namespace User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use User\Data\Models\User;

class GetUserProfileTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $endpoint = "/api/user";

    public function test_user_can_gets_its_profile(): void
    {
        $user = $this->prepareUser();
        Sanctum::actingAs(
            $user,
        );

        $response = $this->getJson($this->endpoint);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
            ]
        ]);
    }

    public function test_user_cannot_get_its_profile_without_access_token(): void
    {
        $this->prepareUser();

        $response = $this->getJson($this->endpoint);

        $response->assertStatus(401);
    }

    private function prepareUser():User
    {
        $password = $this->faker->password;
        $data =  [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $password,
        ];
        return User::factory()->create($data);
    }
}
