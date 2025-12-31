<?php

    use Livewire\Attributes\Layout;
    use Livewire\Volt\Component;

    new #[Layout('layouts.app')] class extends Component
    {
        // DUMMY DATA
        public function with(): array
        {
            return [
                'courses'      => [
                    [
                        'id'                => 1,
                        'title'             => 'Python for Financial Analysis Next and Algorithmic Trading',
                        'image'             => 'https://images.unsplash.com/photo-1526304640152-d4619684e484?auto=format&fit=crop&q=80&w=800',
                        'lessons'           => 12,
                        'level'             => 'Beginner',
                        'instructor_name'   => 'Adam Smith',
                        'instructor_avatar' => 'https://i.pravatar.cc/150?u=1',
                        'instructor_role'   => 'Python Developer',
                        'students'          => '504',
                        'price'             => 299000,
                    ],
                    [
                        'id'                => 2,
                        'title'             => 'Mastering AI: From Zero to Hero with Deep Learning',
                        'image'             => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?auto=format&fit=crop&q=80&w=800',
                        'lessons'           => 24,
                        'level'             => 'Intermediate',
                        'instructor_name'   => 'Sarah Connor',
                        'instructor_avatar' => 'https://i.pravatar.cc/150?u=2',
                        'instructor_role'   => 'AI Researcher',
                        'students'          => '1.2k',
                        'price'             => 450000,
                    ],
                    [
                        'id'                => 3,
                        'title'             => 'Data Science Bootcamp: Complete Real World Projects',
                        'image'             => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=800',
                        'lessons'           => 18,
                        'level'             => 'Advanced',
                        'instructor_name'   => 'John Doe',
                        'instructor_avatar' => 'https://i.pravatar.cc/150?u=3',
                        'instructor_role'   => 'Data Scientist',
                        'students'          => '890',
                        'price'             => 399000,
                    ],
                ],
                'testimonials' => [
                    ['name' => 'Sarah L.', 'role' => 'Student', 'text' => 'This platform made learning AI so much easier. The courses are well-structured.'],
                    ['name' => 'Michael B.', 'role' => 'Developer', 'text' => 'Incredible depth of knowledge provided. Highly recommended for beginners.'],
                    ['name' => 'Jessica T.', 'role' => 'Analyst', 'text' => 'Best investment for my career. The financial analysis course is top notch.'],
                ],
            ];
        }
}?>

<div class="min-h-screen bg-slate-50 font-[Poppins] pb-20">

    <section class="relative pt-40 pb-20 px-6 overflow-hidden">
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

            <div class="max-w-xl mx-auto relative mb-16">
                <input type="text" placeholder="Cari kursus, misalnya Python..." class="w-full py-4 pl-6 pr-32 rounded-full border-none shadow-xl shadow-slate-200/60 focus:ring-2 focus:ring-indigo-100 text-sm">
                <button class="absolute right-2 top-2 bottom-2 bg-slate-700 hover:bg-slate-800 text-white px-6 rounded-full text-sm font-medium transition">
                    Search Course
                </button>
            </div>

            <p class="text-xs text-slate-400 mb-6 font-medium tracking-wide">KAMI DIPERCAYA OLEH PARA PEMIMPIN INDUSTRI</p>
            <div class="flex flex-wrap justify-center gap-8 opacity-40 grayscale">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" class="h-6" alt="Logo">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg" class="h-6" alt="Logo">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg" class="h-6" alt="Logo">
                <img src="https://upload.wikimedia.org/wikipedia/commons/0/08/Netflix_2015_logo.svg" class="h-6" alt="Logo">
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 mb-24">
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 mb-2">Perjalanan AI Anda <br/> Dimulai di Sini</h2>
            </div>
            <p class="text-slate-500 text-sm max-w-sm text-right md:text-left">
                Anda belum mendaftar kursus apa pun. Pilih kelas pertama Anda dan mulailah menjelajahi kecerdasan buatan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($courses as $course)
                <livewire:components.course-card :course="$course" :key="'featured-'.$course['id']" />
            @endforeach
        </div>
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

            <div class="bg-white border border-slate-100 rounded-2xl p-4 flex items-center justify-between hover:shadow-md transition cursor-pointer">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-500">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    </div>
                    <span class="text-sm font-medium text-slate-700">Quiz: Supervised Learning Basics</span>
                </div>
                <span class="text-xs text-slate-400">15 min</span>
            </div>

             <div class="bg-white border border-slate-100 rounded-2xl p-4 flex items-center justify-between hover:shadow-md transition cursor-pointer">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-500">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <span class="text-sm font-medium text-slate-700">Read: Neural Networks Overview</span>
                </div>
                <span class="text-xs text-slate-400">10 min</span>
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
            <div class="bg-white p-6 rounded-3xl shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <img src="https://i.pravatar.cc/150?u={{ $loop->index + 10 }}" class="w-10 h-10 rounded-full" alt="">
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
            <p class="text-slate-500 text-sm mt-2">Berdasarkan jalur pembelajaran Anda, berikut adalah kursus yang menurut kami akan Anda sukai.</p>
        </div>
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($courses as $course)
                <livewire:components.course-card :course="$course" :key="'rec-'.$course['id']" />
            @endforeach
        </div>
    </section>

    <div class="max-w-4xl mx-auto text-center mb-20">
        <h2 class="text-3xl font-bold text-slate-700 mb-4">Memberdayakan Generasi <br> Inovator AI Berikutnya</h2>
        <p class="text-slate-400 text-sm max-w-lg mx-auto mb-8">
            We provide cutting-edge AI learning experiences that schools often don't cover. Join us today.
        </p>
        <button class="bg-slate-600 text-white px-8 py-3 rounded-full text-sm font-semibold shadow-lg hover:bg-slate-700 transition">
            Discover More
        </button>
    </div>


</div>
