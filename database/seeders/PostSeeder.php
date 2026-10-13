<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run():void
    {
        $categories = Category::factory()->count(5)->create();

        foreach ($categories as $category) {
            Post::factory()->count(3)->create([
                'category_id' => $category->id,
            ]);
        }
    }

}
