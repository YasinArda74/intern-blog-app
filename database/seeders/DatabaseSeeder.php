<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $categories = Category::factory()->count(5)->create();

        foreach ($categories as $category) {
            Post::factory()->count(3)->create([
                'category_id' => $category->id,
            ]);
        }
    }
}
