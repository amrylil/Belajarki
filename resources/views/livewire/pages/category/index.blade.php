<?php

    use App\Models\Category;
    use App\Models\Course;
    use Livewire\Attributes\Layout;
    use Livewire\Attributes\Url;
    use Livewire\Volt\Component;
    use Livewire\WithPagination;

    new #[Layout('layouts.app')] class extends Component
    {
        use WithPagination;

        #[Url]
        public $search = '';

        #[Url]
        public $category = 'all';

        public function setCategory($slug)
        {
            $this->category = $slug;
            $this->resetPage();
        }

        public function with(): array
        {
            return [
                'categories' => Category::has('courses')->get(),
                'courses'    => Course::query()
                    ->with(['category', 'tags', 'modules'])
                    ->where('is_published', true)
                    ->when($this->search, function ($query) {
                        $query->where('title', 'like', '%' . $this->search . '%');
                    })
                    ->when($this->category !== 'all', function ($query) {
                        $query->whereHas('category', function ($q) {
                            $q->where('slug', $this->category);
                        });
                    })
                    ->latest()
                    ->paginate(9),
            ];
        }
}?>

<div class="min-h-screen bg-slate-50 font-[Poppins] pt-24 pb-20">
    <div class="max-w-4xl mx-auto text-center px-6 mb-12">
        <h4 class="text-indigo-600 font-bold text-sm mb-2 tracking-wider uppercase">EKSPLORASI</h4>
        <h1 class="text-3xl md:text-5xl font-bold text-slate-800 leading-tight mb-4">
            Kategori Kursus Teknologi
        </h1>
        <p class="text-slate-500 max-w-2xl mx-auto mb-8 text-sm leading-relaxed">
            Bangun kemampuan teknologi secara bertahap melalui pembelajaran berbasis praktik.
        </p>

        <div class="max-w-xl mx-auto relative shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <input wire:model.live.debounce.300ms="search" type="text"
                   class="block w-full pl-10 pr-24 py-3 border border-slate-200 rounded-full leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition"
                   placeholder="Cari teknologi (misal: Laravel)...">
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-slate-800 mb-4 md:mb-0">Kategori Kursus</h2>
        </div>

        <div class="flex flex-wrap gap-3 mb-10">
            <button wire:click="setCategory('all')"
                class="px-5 py-2 rounded-full text-xs font-semibold border transition duration-200
                {{ $category === 'all' ? 'bg-indigo-700 text-white border-indigo-700 shadow-lg shadow-indigo-200' : 'bg-white text-slate-600 border-slate-200 hover:border-indigo-300 hover:text-indigo-600' }}">
                Semua
            </button>
            @foreach($categories as $cat)
                <button wire:click="setCategory('{{ $cat->slug }}')"
                    class="px-5 py-2 rounded-full text-xs font-semibold border transition duration-200
                    {{ $category === $cat->slug ? 'bg-indigo-700 text-white border-indigo-700 shadow-lg shadow-indigo-200' : 'bg-white text-slate-600 border-slate-200 hover:border-indigo-300 hover:text-indigo-600' }}">
                    {{ $cat->name }}
                </button>
            @endforeach
        </div>

        <div class="border-t border-slate-200 border-dashed pt-10">
            @if($courses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($courses as $course)
                        <livewire:components.course-card :course="$course" :key="$course->id" />
                    @endforeach
                </div>
                <div class="mt-12">{{ $courses->links() }}</div>
            @else
                <div class="text-center py-20">
                    <p class="text-slate-500">Tidak ada kursus ditemukan.</p>
                    <button wire:click="$set('search', '')" class="mt-4 text-indigo-600 font-bold hover:underline">Reset</button>
                </div>
            @endif
        </div>
    </section>
</div>
