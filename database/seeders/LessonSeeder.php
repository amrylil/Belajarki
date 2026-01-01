<?php
namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('lessons')->insert([
            // Modul 1
            [
                'id'         => 'e0000000-0000-0000-0000-000000000001',
                'module_id'  => 'd0000000-0000-0000-0000-000000000001',
                'title'      => 'What is Laravel?',
                'type'       => 'video',
                'content'    => 'https://www.youtube.com/embed/ImtZ5yENzgE',
                'duration'   => 10,
                'is_preview' => true,
                'sort'       => 1,
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'id'         => 'e0000000-0000-0000-0000-000000000002',
                'module_id'  => 'd0000000-0000-0000-0000-000000000001',
                'title'      => 'Installation Setup',
                'type'       => 'text',
                'content'    => 'To install Laravel...',
                'duration'   => 5,
                'is_preview' => false,
                'sort'       => 2,
                'created_at' => $now, 'updated_at' => $now,
            ],
            // Modul 2
            [
                'id'         => 'e0000000-0000-0000-0000-000000000003',
                'module_id'  => 'd0000000-0000-0000-0000-000000000002',
                'title'      => 'Understanding Migrations',
                'type'       => 'video',
                'content'    => 'https://www.youtube.com/embed/example',
                'duration'   => 15,
                'is_preview' => false,
                'sort'       => 1,
                'created_at' => $now, 'updated_at' => $now,
            ],
        ]);
    }
}
