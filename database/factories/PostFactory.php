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
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->text(),
            'content' => json_encode($this->faker->paragraphs(5, true)),
            'status' => $this->faker->randomElement(['published', 'draft', 'archived']),
            'is_featured' => $this->faker->randomElement([false, true]),
            'views_count' => $this->faker->randomDigit(),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
