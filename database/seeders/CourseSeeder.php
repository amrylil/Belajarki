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
            // COURSE 1: AI & LLM
            [
                'id'           => 'c0000000-0000-0000-0000-000000000011',
                'category_id'  => 'a0000000-0000-0000-0000-000000000003', // Data Science
                'title'        => 'Building AI Apps with LLM & RAG',
                'slug'         => 'building-ai-apps-llm-rag',
                'thumbnail'    => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&q=80&w=800',

                // DESKRIPSI PANJANG
                'description'  => "Revolusi AI sedang terjadi, dan Large Language Models (LLM) adalah intinya. Dalam kursus komprehensif ini, Anda tidak hanya akan belajar teori, tetapi juga praktik langsung membangun aplikasi cerdas yang dapat memahami konteks bisnis Anda.\n\nKami akan membahas secara mendalam teknik Retrieval Augmented Generation (RAG) untuk mengatasi keterbatasan halusinasi pada AI. Anda akan belajar cara menghubungkan OpenAI API dengan Vector Database, memproses dokumen PDF/Text menjadi embedding, dan membuat chatbot yang dapat menjawab pertanyaan berdasarkan data pribadi atau perusahaan Anda.\n\nKurikulum ini dirancang untuk developer yang ingin naik level menjadi AI Engineer. Prasyarat: Pemahaman dasar Python.",

                'price'        => 0,
                'level'        => 'advanced',
                'is_published' => true,
                'created_at'   => $now, 'updated_at' => $now,
            ],

            // COURSE 2: Backend Clean Arch
            [
                'id'           => 'c0000000-0000-0000-0000-000000000012',
                'category_id'  => 'a0000000-0000-0000-0000-000000000001', // Web Dev
                'title'        => 'Professional Backend: Golang Clean Architecture',
                'slug'         => 'golang-clean-architecture',
                'thumbnail'    => 'https://lh7-rt.googleusercontent.com/docsz/AD_4nXdvS7UQMmVj_l1ipIzh_jzHV4opA8CbW8m1rWqBv231oJhwdU7IS0ta6huKWklGXqOxOsYpQurDscdzArhZCrAg6uIM2P3GJ4UUWVgtXC66xYnBGKPBVtOc1T-Zpy_Z2WPX3gk6?key=xwEEBKFq6h_YmmrZuDsMtA',

                // DESKRIPSI PANJANG
                'description'  => "Membangun backend yang scalable dan maintainable adalah tantangan terbesar di industri saat ini. Kursus ini hadir untuk membongkar rahasia di balik arsitektur yang digunakan oleh perusahaan teknologi besar (Unicorn). Menggunakan bahasa pemrograman Go (Golang) yang terkenal dengan performa tinggi.\n\nAnda akan belajar menerapkan Clean Architecture (Robert C. Martin) secara disiplin. Kita akan memisahkan kode menjadi layer Repository, Usecase, dan Delivery. Materi mencakup penggunaan Gin Framework, Dependency Injection, Unit Testing dengan Mocking, hingga manajemen transaksi database yang aman.\n\nCocok untuk Anda yang lelah dengan 'Spaghetti Code' dan ingin menulis kode yang rapi, mudah dites, dan siap untuk skala besar.",

                'price'        => 0,
                'level'        => 'intermediate',
                'is_published' => true,
                'created_at'   => $now, 'updated_at' => $now,
            ],

            // COURSE 3: DevOps CI/CD
            [
                'id'           => 'c0000000-0000-0000-0000-000000000013',
                'category_id'  => 'a0000000-0000-0000-0000-000000000001', // Web Dev
                'title'        => 'DevOps Masterclass: Docker, K8s, & CI/CD',
                'slug'         => 'devops-masterclass-cicd',
                'thumbnail'    => 'https://shalb.com/wp-content/uploads/2019/11/Devops1-2048x1338.jpeg',

                // DESKRIPSI PANJANG
                'description'  => "Jembatani kesenjangan antara Development dan Operations. Di era modern, deployment manual adalah masa lalu. Kursus ini akan melatih Anda menjadi seorang DevOps Engineer yang handal, menguasai tools standar industri dari nol.\n\nKita akan mulai dengan Docker untuk membungkus aplikasi dalam container, memastikan aplikasi berjalan sama di mana saja. Kemudian, kita lanjut ke orkestrasi menggunakan Kubernetes (K8s) untuk scaling otomatis. Terakhir, kita akan membangun pipeline CI/CD otomatis menggunakan GitHub Actions, di mana setiap kode yang di-push akan otomatis di-test dan di-deploy ke server production.\n\nJangan biarkan server down membuat Anda panik. Otomatisasi segalanya sekarang juga.",

                'price'        => 0,
                'level'        => 'advanced',
                'is_published' => true,
                'created_at'   => $now, 'updated_at' => $now,
            ],
        ]);

        // JANGAN LUPA PIVOT TAGS (Agar tidak error constraint)
        DB::table('course_tag')->insert([
            ['course_id' => 'c0000000-0000-0000-0000-000000000011', 'tag_id' => 'b0000000-0000-0000-0000-000000000006'], // Python
            ['course_id' => 'c0000000-0000-0000-0000-000000000012', 'tag_id' => 'b0000000-0000-0000-0000-000000000001'], // Laravel (Placeholder Golang)
            ['course_id' => 'c0000000-0000-0000-0000-000000000013', 'tag_id' => 'b0000000-0000-0000-0000-000000000004'], // Tailwind (Placeholder)
        ]);
    }
}
