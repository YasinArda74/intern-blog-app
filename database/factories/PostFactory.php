<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
