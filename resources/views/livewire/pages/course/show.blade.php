<?php

    use App\Models\Course;
    use App\Models\Enrollment;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Attributes\Layout;
    use Livewire\Volt\Component;

    new #[Layout('layouts.app')] class extends Component
    {
        public Course $course;
        public $isEnrolled = false;

        public function mount($slug)
        {
            // Ambil data course + syllabus
            $this->course = Course::with(['modules.lessons', 'category', 'tags'])
                ->where('slug', $slug)
                ->where('is_published', true)
                ->firstOrFail();

            // Cek status enrollment
            if (Auth::check()) {
                $this->isEnrolled = Enrollment::where('user_id', Auth::id())
                    ->where('course_id', $this->course->id)
                    ->exists();
            }
        }

        public function joinCourse()
        {
            // 1. Cek Login
            if (! Auth::check()) {
                return redirect()->route('login');
            }

            // 2. Logic Enroll (Simpan ke Database)
            if (! $this->isEnrolled) {
                Enrollment::create([
                    'user_id'      => Auth::id(),
                    'course_id'    => $this->course->id,
                    'is_completed' => false,
                ]);
            }

            // 3. Cari Lesson Pertama untuk Redirect
            $firstLesson = $this->course->modules->first()?->lessons->first();

            if ($firstLesson) {
                // Redirect ke Learning Player
                return redirect()->route('learning.player', [
                    'course' => $this->course->slug,
                    'lesson' => $firstLesson->id,
                ]);
            } else {
                // Fallback jika belum ada materi
                session()->flash('error', 'Materi kursus sedang disiapkan.');
            }
        }
}?>
<div class="min-h-screen bg-slate-50 font-[Poppins] pt-28 pb-20">

    <div class="absolute top-0 left-0 w-full h-[500px] bg-gradient-to-b from-indigo-50 to-slate-50 -z-10"></div>

    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-3 gap-10">

        <div class="lg:col-span-2">

            <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-6">
                <a href="{{ route('courses.index') }}" class="hover:text-indigo-600">Courses</a>
                <span>/</span>
                <span class="text-slate-800">{{ $course->category->name }}</span>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold text-slate-800 leading-tight mb-4">
                {{ $course->title }}
            </h1>
            <p class="text-slate-500 mb-6 text-sm leading-relaxed">
                Pelajari materi ini secara mendalam mulai dari dasar hingga tingkat lanjut.
                Disusun oleh para ahli industri untuk membantu karier Anda.
            </p>

            <div class="flex flex-wrap gap-2 mb-8">
                @foreach($course->tags as $tag)
                    <span class="px-3 py-1 bg-white border border-slate-200 rounded-full text-xs font-bold text-slate-600">
                        #{{ $tag->name }}
                    </span>
                @endforeach
            </div>

            <img src="{{ $course->thumbnail ?? 'https://via.placeholder.com/800x400' }}"
                 class="w-full rounded-[2rem] shadow-sm mb-10" alt="{{ $course->title }}">

            <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm mb-8">
                <h3 class="text-xl font-bold text-slate-800 mb-6">Tentang Kursus</h3>
                <div class="prose prose-slate prose-sm max-w-none text-slate-500">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm">
                <h3 class="text-xl font-bold text-slate-800 mb-6">Materi Pembelajaran</h3>

                <div class="space-y-4">
                    @forelse($course->modules as $module)
                        <details class="group border border-slate-100 rounded-2xl overflow-hidden open:bg-slate-50 transition">
                            <summary class="flex items-center justify-between p-4 cursor-pointer bg-white group-open:bg-slate-50">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center text-xs font-bold">
                                        {{ $loop->iteration }}
                                    </span>
                                    <span class="font-bold text-slate-700 text-sm">{{ $module->title }}</span>
                                </div>
                                <span class="text-slate-400 group-open:rotate-180 transition">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </span>
                            </summary>
                            <div class="p-4 pt-0 border-t border-slate-100">
                                <ul class="space-y-3 mt-3">
                                    @foreach($module->lessons as $lesson)
                                        <li class="flex items-center gap-3 text-sm text-slate-500">
                                            <svg class="w-4 h-4 {{ $lesson->type == 'video' ? 'text-pink-500' : 'text-blue-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                @if($lesson->type == 'video')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                @endif
                                            </svg>
                                            <span>{{ $lesson->title }}</span>
                                            <span class="ml-auto text-xs text-slate-400">{{ $lesson->duration }} min</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </details>
                    @empty
                        <p class="text-center text-slate-400 text-sm py-4">Belum ada materi.</p>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="lg:col-span-1">
            <div class="sticky top-28 space-y-6">

                <div class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-xl shadow-slate-200/50">
                    <div class="mb-6">
                        <p class="text-sm text-slate-400 mb-1">Harga Kursus</p>
                        <h2 class="text-3xl font-bold text-indigo-600">
                            {{ $course->price == 0 ? 'Gratis' : 'Rp'.number_format($course->price, 0, ',', '.') }}
                        </h2>
                    </div>

                    @if($isEnrolled)
                        <button wire:click="joinCourse" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-bold py-4 rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                            <span>Lanjutkan Belajar</span>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </button>
                    @else
                        <button wire:click="joinCourse" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-indigo-200 transition mb-3">
                            Enroll Now
                        </button>
                        <p class="text-center text-xs text-slate-400">Jaminan uang kembali 30 hari.</p>
                    @endif

                    <div class="border-t border-slate-100 my-6"></div>

                    <h4 class="font-bold text-slate-800 text-sm mb-4">Yang akan kamu dapatkan:</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-sm text-slate-500">
                            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            <span>Akses selamanya</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-500">
                            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            <span>{{ $course->modules->count() }} Modul pembelajaran</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-500">
                            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            <span>Sertifikat kelulusan</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm flex items-center gap-4">
                    <img src="https://ui-avatars.com/api/?name=Admin+Guru" class="w-12 h-12 rounded-full border border-slate-200" alt="">
                    <div>
                        <p class="text-xs text-slate-400">Instruktur</p>
                        <h4 class="font-bold text-slate-800">Admin Guru</h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
