<?php

namespace Post\Data\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Post\Data\Models\Post;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'user_id' => $this->faker->numberBetween(1, 10),
            'content' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
