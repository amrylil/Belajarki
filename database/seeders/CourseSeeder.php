<?php
namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('courses')->insert([
            // COURSE 1: Laravel
            [
                'id'           => 'c0000000-0000-0000-0000-000000000001',
                'category_id'  => 'a0000000-0000-0000-0000-000000000001', // Web Dev
                'title'        => 'Mastering Laravel 11 for Beginners',
                'slug'         => 'mastering-laravel-11',
                'thumbnail'    => 'https://images.unsplash.com/photo-1542831371-29b0f74f9713?auto=format&fit=crop&q=80&w=800',
                'price'        => 150000,
                'level'        => 'beginner',
                'is_published' => true,
                'created_at'   => $now, 'updated_at' => $now,
            ],
            // COURSE 2: Python
            [
                'id'           => 'c0000000-0000-0000-0000-000000000002',
                'category_id'  => 'a0000000-0000-0000-0000-000000000003', // Data Science
                'title'        => 'Python for Data Analysis',
                'slug'         => 'python-data-analysis',
                'thumbnail'    => 'https://images.unsplash.com/photo-1526304640152-d4619684e484?auto=format&fit=crop&q=80&w=800',
                'price'        => 250000,
                'level'        => 'intermediate',
                'is_published' => true,
                'created_at'   => $now, 'updated_at' => $now,
            ],
        ]);

        DB::table('course_tag')->insert([
            // Course 1 (Laravel) -> Tag Laravel & Tailwind
            ['course_id' => 'c0000000-0000-0000-0000-000000000001', 'tag_id' => 'b0000000-0000-0000-0000-000000000001'],
            ['course_id' => 'c0000000-0000-0000-0000-000000000001', 'tag_id' => 'b0000000-0000-0000-0000-000000000004'],

            // Course 2 (Python) -> Tag Python
            ['course_id' => 'c0000000-0000-0000-0000-000000000002', 'tag_id' => 'b0000000-0000-0000-0000-000000000006'],
        ]);
    }
}
