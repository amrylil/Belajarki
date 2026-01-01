<?php

    use App\Models\Course;
    use App\Models\Enrollment;
    use App\Models\Lesson;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Attributes\Layout;
    use Livewire\Volt\Component;

    // Gunakan layout app, tapi nanti kita hide navbar bawaan dengan CSS full screen
    new #[Layout('layouts.app')] class extends Component
    {
        public Course $course;
        public Lesson $currentLesson;

        public $nextLessonId = null;
        public $prevLessonId = null;

        public function mount($course, $lesson)
        {
            // 1. Ambil Data
            $this->course        = Course::with(['modules.lessons'])->where('slug', $course)->firstOrFail();
            $this->currentLesson = Lesson::where('id', $lesson)->firstOrFail();

            // 2. SECURITY CHECK: Pastikan user sudah enroll!
            $hasAccess = Enrollment::where('user_id', Auth::id())
                ->where('course_id', $this->course->id)
                ->exists();

            if (! $hasAccess) {
                abort(403, 'Anda belum mendaftar kursus ini.');
            }

            // 3. Setup Navigasi (Next/Prev)
            $this->setupNavigation();
        }

        public function setupNavigation()
        {
            // Flatten semua lesson menjadi satu collection urut
            $allLessons = $this->course->modules->flatMap->lessons;

            // Cari posisi lesson saat ini
            $currentIndex = $allLessons->search(fn($l) => $l->id === $this->currentLesson->id);

            // Set ID Next & Prev
            if ($currentIndex !== false) {
                $this->prevLessonId = $currentIndex > 0 ? $allLessons[$currentIndex - 1]->id : null;
                $this->nextLessonId = $currentIndex < $allLessons->count() - 1 ? $allLessons[$currentIndex + 1]->id : null;
            }
        }

        public function goToLesson($lessonId)
        {
            return redirect()->route('learning.player', [
                'course' => $this->course->slug,
                'lesson' => $lessonId,
            ]);
        }
}?>

<div class="min-h-screen bg-slate-50 font-[Poppins] flex flex-col pt-20"> <div class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between sticky top-20 z-30">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="p-2 hover:bg-slate-100 rounded-full transition text-slate-500">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </a>
            <div>
                <h1 class="font-bold text-slate-800 text-sm md:text-base line-clamp-1">{{ $course->title }}</h1>
            </div>
        </div>

        <div class="hidden md:flex items-center gap-3">
            <span class="text-xs font-bold text-slate-500">Progress Belajar</span>
            <div class="w-32 h-2 bg-slate-100 rounded-full">
                <div class="h-2 bg-green-500 rounded-full" style="width: 10%"></div>
            </div>
        </div>
    </div>

    <div class="flex-1 max-w-7xl mx-auto w-full p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-6">

            <div class="bg-black rounded-2xl overflow-hidden aspect-video shadow-lg relative group">
                @if($currentLesson->type == 'video')
                    <iframe src="{{ $currentLesson->content }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                @else
                    <div class="bg-white h-full p-8 overflow-y-auto prose max-w-none">
                        {!! $currentLesson->content !!}
                    </div>
                @endif
            </div>

            <div class="flex flex-col gap-4">
                <div class="flex items-start justify-between">
                    <h2 class="text-2xl font-bold text-slate-800">{{ $currentLesson->title }}</h2>

                    <button class="flex items-center gap-2 px-4 py-2 border border-slate-200 rounded-full text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Tandai Selesai
                    </button>
                </div>

                <div class="flex items-center justify-between mt-4">
                    @if($prevLessonId)
                        <button wire:click="goToLesson('{{ $prevLessonId }}')" class="flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-700 rounded-xl font-bold text-sm hover:bg-slate-50 transition">
                            &larr; Sebelumnya
                        </button>
                    @else
                        <div></div> @endif

                    @if($nextLessonId)
                        <button wire:click="goToLesson('{{ $nextLessonId }}')" class="flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold text-sm hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                            Selanjutnya &rarr;
                        </button>
                    @endif
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 mt-6">
                <h3 class="font-bold text-slate-800 mb-2">Deskripsi Materi</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Tidak ada deskripsi tambahan untuk materi ini. Fokus pada video pembelajaran di atas.
                </p>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white border border-slate-100 rounded-[1.5rem] overflow-hidden shadow-sm sticky top-40">
                <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800">Daftar Materi</h3>
                    <p class="text-xs text-slate-400 mt-1">{{ $course->modules->count() }} Modul • {{ $course->modules->sum(fn($m) => $m->lessons->count()) }} Pelajaran</p>
                </div>

                <div class="max-h-[600px] overflow-y-auto">
                    @foreach($course->modules as $module)
                        <div x-data="{ open: true }"> <button @click="open = !open" class="w-full flex items-center justify-between p-4 bg-slate-50/80 hover:bg-slate-100 transition text-left border-b border-slate-100">
                                <span class="font-bold text-slate-700 text-xs uppercase tracking-wide">{{ $module->title }}</span>
                                <svg class="w-4 h-4 text-slate-400 transform transition" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>

                            <div x-show="open" class="bg-white">
                                @foreach($module->lessons as $lesson)
                                    @php
                                        $isActive = $lesson->id === $currentLesson->id;
                                    @endphp

                                    <button wire:click="goToLesson('{{ $lesson->id }}')"
                                            class="w-full flex items-start gap-3 p-4 border-b border-slate-50 transition text-left
                                            {{ $isActive ? 'bg-indigo-50 border-indigo-100' : 'hover:bg-slate-50' }}">

                                        <div class="mt-0.5">
                                            @if($isActive)
                                                <div class="w-5 h-5 rounded-full bg-indigo-600 flex items-center justify-center shadow-md shadow-indigo-300">
                                                    <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /></svg>
                                                </div>
                                            @else
                                                <div class="w-5 h-5 rounded-full border-2 border-slate-300"></div>
                                            @endif
                                        </div>

                                        <div>
                                            <p class="text-sm font-medium {{ $isActive ? 'text-indigo-700' : 'text-slate-600' }}">
                                                {{ $lesson->title }}
                                            </p>
                                            <p class="text-[10px] text-slate-400 flex items-center gap-1 mt-1">
                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                {{ $lesson->duration }} min
                                            </p>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
