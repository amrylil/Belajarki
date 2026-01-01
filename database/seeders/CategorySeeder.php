<?php
namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('categories')->insert([
            [
                'id'         => 'a0000000-0000-0000-0000-000000000001', // Web Dev
                'name'       => 'Web Development',
                'slug'       => 'web-development',
                'icon'       => null,
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'id'         => 'a0000000-0000-0000-0000-000000000002', // Mobile Dev
                'name'       => 'Mobile Development',
                'slug'       => 'mobile-development',
                'icon'       => null,
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'id'         => 'a0000000-0000-0000-0000-000000000003', // Data Science
                'name'       => 'Data Science',
                'slug'       => 'data-science',
                'icon'       => null,
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'id'         => 'a0000000-0000-0000-0000-000000000004', // UI/UX
                'name'       => 'UI/UX Design',
                'slug'       => 'ui-ux-design',
                'icon'       => null,
                'created_at' => $now, 'updated_at' => $now,
            ],
        ]);
    }
}
