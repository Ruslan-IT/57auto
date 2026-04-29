<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicSeeder extends Seeder
{
    public function run(): void
    {
        Topic::insert([
            [
                'title' => 'Basics',
                'slug' => 'basics',
                'order' => 1,
            ],
            [
                'title' => 'Filtering',
                'slug' => 'filtering',
                'order' => 2,
            ],
            [
                'title' => 'Aggregation',
                'slug' => 'aggregation',
                'order' => 3,
            ],
            [
                'title' => 'Joins',
                'slug' => 'joins',
                'order' => 4,
            ],
            [
                'title' => 'Subqueries',
                'slug' => 'subqueries',
                'order' => 5,
            ],
        ]);
    }
}
