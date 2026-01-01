<?php

    use App\Models\Course;
    use Livewire\Attributes\Layout;
    use Livewire\Volt\Component;

    new #[Layout('layouts.app')] class extends Component
    {
        public function with(): array
        {
            return [
                // 1. Ambil Data Real dari Database
                'courses'      => Course::query()
                    ->with(['category', 'tags', 'modules.lessons']) // Eager load agar performa cepat
                    ->where('is_published', true)                   // Hanya yang sudah publish
                    ->latest()
                    ->take(6) // Batasi tampilkan 6 kursus terbaru di home
                    ->get(),

                // 2. Testimoni (Biarkan static array karena belum ada tabelnya di MVP)
                'testimonials' => [
                    ['name' => 'Sarah L.', 'role' => 'Student', 'text' => 'This platform made learning AI so much easier. The courses are well-structured.'],
                    ['name' => 'Michael B.', 'role' => 'Developer', 'text' => 'Incredible depth of knowledge provided. Highly recommended for beginners.'],
                    ['name' => 'Jessica T.', 'role' => 'Analyst', 'text' => 'Best investment for my career. The financial analysis course is top notch.'],
                ],
            ];
        }
}?>

<div class="min-h-screen bg-slate-50 font-[Poppins] pt-24 pb-20">

    <section class="relative pt-20 pb-20 px-6 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full -z-10">
            <div class="absolute top-[-20%] left-[20%] w-[500px] h-[500px] bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-[-20%] right-[20%] w-[500px] h-[500px] bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        </div>

        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-slate-800 leading-tight mb-6">
                Membentuk Masa Depan,<br/>
                Satu Pikiran AI pada Satu Waktu
            </h1>
            <p class="text-slate-500 max-w-2xl mx-auto mb-10 text-sm md:text-base">
                An innovative learning platform designed to equip you with the skills and knowledge needed to thrive in the era of Artificial Intelligence.
            </p>

            <form action="{{ route('courses.index') }}" method="GET" class="max-w-xl mx-auto relative mb-16">
                <input type="text" name="search" placeholder="Cari kursus, misalnya Python..." class="w-full py-4 pl-6 pr-32 rounded-full border-none shadow-xl shadow-slate-200/60 focus:ring-2 focus:ring-indigo-100 text-sm">
                <button type="submit" class="absolute right-2 top-2 bottom-2 bg-slate-700 hover:bg-slate-800 text-white px-6 rounded-full text-sm font-medium transition">
                    Search Course
                </button>
            </form>

            <p class="text-xs text-slate-400 mb-6 font-medium tracking-wide">KAMI DIPERCAYA OLEH PARA PEMIMPIN INDUSTRI</p>
            <div class="flex flex-wrap justify-center gap-8 opacity-40 grayscale">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" class="h-6" alt="Amazon">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg" class="h-6" alt="Google">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg" class="h-6" alt="Microsoft">
                <img src="https://upload.wikimedia.org/wikipedia/commons/0/08/Netflix_2015_logo.svg" class="h-6" alt="Netflix">
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 mb-24">
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 mb-2">Perjalanan AI Anda <br/> Dimulai di Sini</h2>
                <p class="text-slate-500 text-sm">Jelajahi kursus terbaru kami.</p>
            </div>

            <a href="{{ route('courses.index') }}" wire:navigate class="text-indigo-600 text-sm font-bold hover:underline">
                Lihat Semua Kursus &rarr;
            </a>
        </div>

        @if($courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($courses as $course)
                    <livewire:components.course-card :course="$course" :key="'featured-'.$course->id" />
                @endforeach
            </div>
        @else
            <div class="text-center py-10 bg-white rounded-3xl border border-slate-100">
                <p class="text-slate-400">Belum ada kursus yang dipublikasikan.</p>
            </div>
        @endif
    </section>

    <section class="max-w-4xl mx-auto px-6 mb-24">
        <div class="mb-4">
            <h2 class="text-xl font-bold text-slate-800">Target Hari Ini</h2>
            <div class="w-full bg-slate-100 rounded-full h-2.5 mt-4 mb-2">
                <div class="bg-indigo-600 h-2.5 rounded-full" style="width: 15%"></div>
            </div>
            <p class="text-xs text-slate-400">1 of 20 tasks completed</p>
        </div>

        <div class="space-y-4 mt-8">
            <div class="bg-white border border-slate-100 rounded-2xl p-4 flex items-center justify-between hover:shadow-md transition cursor-pointer">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-500">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <span class="text-sm font-medium text-slate-700">Watch: ML Fundamentals - Introduction</span>
                </div>
                <span class="text-xs text-slate-400">45 min</span>
            </div>
            </div>

        <div class="text-center mt-8">
             <button class="bg-slate-700 text-white text-xs px-6 py-2 rounded-full">View Full Plan</button>
        </div>
    </section>

    <section class="bg-slate-100 py-20 mb-24 rounded-[3rem] mx-4">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold text-slate-800">Apa Kata Orang</h2>
        </div>
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($testimonials as $testi)
            <div class="bg-white p-6 rounded-3xl shadow-sm hover:shadow-md transition">
                <div class="flex items-center gap-3 mb-4">
                    <img src="https://ui-avatars.com/api/?name={{ $testi['name'] }}&background=random" class="w-10 h-10 rounded-full" alt="">
                    <div>
                        <h4 class="font-bold text-sm text-slate-800">{{ $testi['name'] }}</h4>
                        <div class="text-[10px] text-yellow-400 flex">★★★★★</div>
                    </div>
                </div>
                <p class="text-slate-500 text-xs leading-relaxed">"{{ $testi['text'] }}"</p>
            </div>
            @endforeach
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 mb-32">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold text-slate-800">Direkomendasikan untuk Anda</h2>
            <p class="text-slate-500 text-sm mt-2">Kursus pilihan untuk meningkatkan skill Anda.</p>
        </div>
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($courses->take(3) as $course)
                <livewire:components.course-card :course="$course" :key="'rec-'.$course->id" />
            @endforeach
        </div>
    </section>

    <div class="max-w-4xl mx-auto text-center mb-20">
        <h2 class="text-3xl font-bold text-slate-700 mb-4">Memberdayakan Generasi <br> Inovator AI Berikutnya</h2>
        <p class="text-slate-400 text-sm max-w-lg mx-auto mb-8">
            We provide cutting-edge AI learning experiences that schools often don't cover. Join us today.
        </p>
        <a href="{{ route('courses.index') }}" wire:navigate class="bg-slate-600 text-white px-8 py-3 rounded-full text-sm font-semibold shadow-lg hover:bg-slate-700 transition">
            Discover More
        </a>
    </div>

</div>
