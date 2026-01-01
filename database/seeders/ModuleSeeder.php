<?php
namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('modules')->insert([
            // Course 1 (Laravel) Modules
            [
                'id'         => 'd0000000-0000-0000-0000-000000000001',
                'course_id'  => 'c0000000-0000-0000-0000-000000000001',
                'title'      => 'Introduction to MVC',
                'sort'       => 1,
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'id'         => 'd0000000-0000-0000-0000-000000000002',
                'course_id'  => 'c0000000-0000-0000-0000-000000000001',
                'title'      => 'Database & Migrations',
                'sort'       => 2,
                'created_at' => $now, 'updated_at' => $now,
            ],

            // Course 2 (Python) Modules
            [
                'id'         => 'd0000000-0000-0000-0000-000000000003',
                'course_id'  => 'c0000000-0000-0000-0000-000000000002',
                'title'      => 'Python Basics',
                'sort'       => 1,
                'created_at' => $now, 'updated_at' => $now,
            ],
        ]);
    }
}
