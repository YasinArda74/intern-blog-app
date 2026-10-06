<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'title' => $title,
            'content' => $this->faker->paragraph(),
            'slug' => $this->faker->slug(),
            'views' => $this->faker->randomDigit(),
        ];
    }
}
