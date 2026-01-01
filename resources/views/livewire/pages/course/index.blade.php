<?php

    use App\Models\Course;
    use Livewire\Attributes\Layout;
    use Livewire\Volt\Component;
    use Livewire\WithPagination;

    new #[Layout('layouts.app')] class extends Component
    {
        use WithPagination;

        public $search = '';

        public function with(): array
        {
            return [
                'courses' => Course::query()
                    ->where('is_published', true)
                    ->where('title', 'like', '%' . $this->search . '%')
                    ->latest()
                    ->paginate(9),
            ];
        }
}?>

<div class="min-h-screen bg-slate-50 font-[Poppins] pt-24 pb-20">

    <div class="max-w-4xl mx-auto text-center px-6 mb-16">
        <h4 class="text-indigo-600 font-bold text-sm mb-2 tracking-wider uppercase">Kursus AI</h4>
        <h1 class="text-4xl md:text-5xl font-bold text-slate-800 leading-tight mb-6">
            Bangun Keahlian AI untuk <br> Masa Depan Kariermu
        </h1>
        <p class="text-slate-500 max-w-2xl mx-auto mb-10 text-sm md:text-base">
            Pelajari AI secara praktikal, berbasis project, dan bisa langsung kamu terapkan dalam dunia industri nyata.
        </p>

        <div class="max-w-xl mx-auto relative">
            <input wire:model.live="search" type="text" placeholder="Cari kursus yang ingin kamu pelajari..."
                class="w-full py-4 pl-12 pr-32 rounded-full border border-slate-200 shadow-sm focus:ring-2 focus:ring-indigo-100 focus:border-indigo-300 text-sm transition">

            <svg class="absolute left-4 top-4 w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>

            <button class="absolute right-2 top-2 bottom-2 bg-indigo-700 hover:bg-indigo-800 text-white px-6 rounded-full text-xs font-bold transition">
                Cari Kursus
            </button>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-slate-800">Semua Kursus AI</h2>
            <span class="text-sm text-slate-500">Menampilkan {{ $courses->total() }} kursus</span>
        </div>

        @if($courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($courses as $course)
                    <livewire:components.course-card :course="$course" :key="$course->id" />
                @endforeach
            </div>

            <div class="mt-12">
                {{ $courses->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-[2rem] border border-slate-100">
                <p class="text-slate-400">Tidak ada kursus yang ditemukan untuk "{{ $search }}"</p>
            </div>
        @endif
    </section>
</div>
