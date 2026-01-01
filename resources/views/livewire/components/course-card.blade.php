<?php

    use App\Models\Course;
    use Livewire\Volt\Component;

    new class extends Component
    {
        public Course $course;

        // Helper untuk menghitung total lesson
        public function with(): array
        {
            return [
                'totalLessons' => $this->course->modules->sum(fn($m) => $m->lessons->count()),
            ];
        }
}; ?>

<div class="group bg-white border border-slate-100 rounded-[2rem] p-4 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
    <a href="{{ route('courses.show', $this->course->slug) }}" wire:navigate class="block relative mb-4 overflow-hidden rounded-[1.5rem]">
        <img src="{{ $this->course->thumbnail ?? 'https://via.placeholder.com/400x250' }}"
             alt="{{ $this->course->title }}"
             class="w-full h-48 object-cover transform group-hover:scale-105 transition duration-500" />

        <div class="absolute -bottom-6 left-6 w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-md border border-slate-50 z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-indigo-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.499 5.258 50.55 50.55 0 00-2.658.813m-15.482 0a50.55 50.55 0 00-2.658-.813m15.482 0a50.55 50.55 0 00-2.658-.813" />
            </svg>
        </div>
    </a>

    <div class="flex items-center justify-end gap-2 mb-3 mt-2">
        <span class="px-3 py-1 bg-slate-50 text-slate-500 text-xs font-medium rounded-full flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            {{ $totalLessons }} Lesson
        </span>
        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-xs font-medium rounded-full capitalize">
            {{ $this->course->level }}
        </span>
    </div>

    <h3 class="text-lg font-bold text-slate-800 leading-tight mb-4 min-h-[3rem]">
        <a href="{{ route('courses.show', $this->course->slug) }}" wire:navigate class="hover:text-indigo-600 transition">
            {{ $this->course->title }}
        </a>
    </h3>

    <div class="flex items-center gap-3 mb-6 mt-auto">
        <img src="https://ui-avatars.com/api/?name=Admin+Guru&background=random" class="w-10 h-10 rounded-full object-cover border border-slate-200" alt="">
        <div class="flex-1">
            <p class="text-xs font-bold text-slate-800">Expert Instructor</p>
            <p class="text-[10px] text-slate-500">Senior Developer</p>
        </div>
        <div class="text-right">
            <p class="text-[10px] text-slate-400">Students</p>
            <p class="text-xs font-bold text-slate-700">1.2k+</p>
        </div>
    </div>

    <div class="flex items-center justify-between pt-4 border-t border-slate-100">
        <span class="text-lg font-bold text-slate-800">
            {{ $this->course->price == 0 ? 'Gratis' : 'Rp'.number_format($this->course->price, 0, ',', '.') }}
        </span>
        <a href="{{ route('courses.show', $this->course->slug) }}" wire:navigate class="bg-indigo-700 hover:bg-indigo-800 text-white text-sm font-semibold py-2.5 px-6 rounded-xl shadow-lg shadow-indigo-200 transition">
            Enroll Now
        </a>
    </div>
</div>
