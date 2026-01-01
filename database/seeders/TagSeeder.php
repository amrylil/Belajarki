<?php
namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('tags')->insert([
            ['id' => 'b0000000-0000-0000-0000-000000000001', 'name' => 'Laravel', 'slug' => 'laravel', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 'b0000000-0000-0000-0000-000000000002', 'name' => 'React JS', 'slug' => 'react-js', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 'b0000000-0000-0000-0000-000000000003', 'name' => 'Vue JS', 'slug' => 'vue-js', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 'b0000000-0000-0000-0000-000000000004', 'name' => 'Tailwind CSS', 'slug' => 'tailwind-css', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 'b0000000-0000-0000-0000-000000000005', 'name' => 'Flutter', 'slug' => 'flutter', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 'b0000000-0000-0000-0000-000000000006', 'name' => 'Python', 'slug' => 'python', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 'b0000000-0000-0000-0000-000000000007', 'name' => 'Figma', 'slug' => 'figma', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
