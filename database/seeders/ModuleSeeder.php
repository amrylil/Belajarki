<?php
namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $now     = Carbon::now();
        $modules = [];

        // --- MODULES UNTUK COURSE 1 (AI & LLM) ---
        // Course ID: c...11
        $aiModules = [
            ['Introduction to LLM & OpenAI API', 1],
            ['Prompt Engineering Mastery', 2],
            ['Building RAG (Retrieval Augmented Generation)', 3],
            ['Deployment & Fine Tuning', 4],
        ];

        foreach ($aiModules as $index => $mod) {
            $modules[] = [
                'id'         => 'd0000000-0000-0000-0000-00000000110' . ($index + 1), // ID: d...1101, d...1102
                'course_id'  => 'c0000000-0000-0000-0000-000000000011',
                'title'      => $mod[0],
                'sort'       => $mod[1],
                'created_at' => $now, 'updated_at' => $now,
            ];
        }

        // --- MODULES UNTUK COURSE 2 (CLEAN ARCH) ---
        // Course ID: c...12
        $beModules = [
            ['Clean Architecture Concept', 1],
            ['Domain Layer Design', 2],
            ['Usecase & Repository Pattern', 3],
            ['Infrastructure & Delivery (Gin Gonic)', 4],
            ['Unit Testing & Mocking', 5],
        ];

        foreach ($beModules as $index => $mod) {
            $modules[] = [
                'id'         => 'd0000000-0000-0000-0000-00000000120' . ($index + 1),
                'course_id'  => 'c0000000-0000-0000-0000-000000000012',
                'title'      => $mod[0],
                'sort'       => $mod[1],
                'created_at' => $now, 'updated_at' => $now,
            ];
        }

        // --- MODULES UNTUK COURSE 3 (DEVOPS) ---
        // Course ID: c...13
        $devopsModules = [
            ['Containerization with Docker', 1],
            ['CI/CD Pipelines (GitHub Actions)', 2],
            ['Server Management (Linux & Nginx)', 3],
            ['Orchestration with Kubernetes', 4],
        ];

        foreach ($devopsModules as $index => $mod) {
            $modules[] = [
                'id'         => 'd0000000-0000-0000-0000-00000000130' . ($index + 1),
                'course_id'  => 'c0000000-0000-0000-0000-000000000013',
                'title'      => $mod[0],
                'sort'       => $mod[1],
                'created_at' => $now, 'updated_at' => $now,
            ];
        }

        DB::table('modules')->insert($modules);
    }
}
