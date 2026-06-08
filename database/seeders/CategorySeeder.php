<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'General',
                'slug' => 'general',
                'description' => 'General category example.',
                'is_active' => true,
            ],
            [
                'name' => 'News',
                'slug' => 'news',
                'description' => 'News category example.',
                'is_active' => true,
            ],
            [
                'name' => 'Archived',
                'slug' => 'archived',
                'description' => 'Inactive category example.',
                'is_active' => false,
            ],
        ];

        foreach ($categories as $category) {
            Category::query()->firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
