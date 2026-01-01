<?php

    use App\Livewire\Actions\Logout;
    use Livewire\Volt\Component;

    new class extends Component
    {
        public function logout(Logout $logout): void
        {
            $logout();
            $this->redirect('/', navigate: true);
        }
}; ?>

<div class="fixed top-6 left-0 right-0 z-50 flex justify-center px-4">
    <nav class="w-full max-w-7xl bg-white/70 backdrop-blur-md border border-white/50 rounded-full px-6 py-3 shadow-sm flex items-center justify-between">

        <div class="flex items-center gap-8">
            <a href="/" wire:navigate class="text-xl font-bold text-slate-800 tracking-tight">
                Belajarki<span class="text-indigo-600">.</span>
            </a>

            <div class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-500">
                {{-- Menggunakan request()->routeIs() untuk menandai menu aktif --}}
                <a href="{{ route('home') }}" wire:navigate
                   class="transition hover:text-indigo-600 {{ request()->routeIs('home') ? 'text-slate-900 font-bold' : '' }}">
                    Beranda
                </a>

                <a href="{{ route('courses.index') }}" wire:navigate
                   class="transition hover:text-indigo-600 {{ request()->routeIs('courses.*') ? 'text-slate-900 font-bold' : '' }}">
                    Kursus
                </a>

  <a href="{{ route('category.index') }}" wire:navigate
   class="transition hover:text-indigo-600 {{ request()->routeIs('category.index') ? 'text-slate-900 font-bold' : '' }}">
   Kategori
</a>
                <a href="{{ route('about') }}" wire:navigate
   class="transition hover:text-indigo-600 {{ request()->routeIs('about') ? 'text-slate-900 font-bold' : '' }}">
   Tentang
</a>
            </div>
        </div>

        <div class="flex items-center gap-3">

            <button class="p-2 hover:bg-slate-100 rounded-full text-slate-500 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>

            @auth
                <div class="flex items-center gap-3 pl-2 border-l border-slate-200">
                    <a href="{{ route('dashboard') }}" wire:navigate class="text-sm font-bold text-slate-700 hover:text-indigo-600">
                        Dashboard
                    </a>

                    <button wire:click="logout" class="text-sm font-medium text-red-500 hover:text-red-700 transition">
                        Log Out
                    </button>

                    <div class="relative ml-1">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()?->name }}&background=random"
                             class="w-8 h-8 rounded-full border border-slate-300 shadow-sm"
                             alt="{{ auth()->user()?->name }}">
                    </div>
                </div>
            @else
                <div class="flex items-center gap-1 pl-2 border-l border-slate-200">
                    <a href="{{ route('login') }}" wire:navigate class="px-4 py-2 text-sm font-bold text-slate-700 hover:text-indigo-600 transition">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" wire:navigate class="hidden sm:block px-5 py-2.5 bg-slate-800 text-white rounded-full text-xs font-semibold hover:bg-slate-700 shadow-lg shadow-slate-300/50 transition transform hover:-translate-y-0.5">
                            Register
                        </a>
                    @endif
                </div>
            @endauth

        </div>
    </nav>
</div>
