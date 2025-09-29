<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::pluck('id')->all();

        if (empty($categories)) {
            $this->call(CategorySeeder::class);
            $categories = Category::pluck('id')->all();
        }

        // Simple seeding tanpa Factory
        for ($i = 1; $i <= 12; $i++) {
            $title = 'Sample Post ' . $i;
            Post::updateOrCreate(
                ['slug' => Str::slug($title) . '-' . $i],
                [
                    'title'       => $title,
                    'body'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Post ke-' . $i . ' untuk contoh CRUD.',
                    'category_id' => $categories[array_rand($categories)],
                ]
            );
        }
    }
}
