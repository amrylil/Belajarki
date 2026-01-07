<?php
?>

<header class="sticky top-0 z-30 w-full bg-white h-16 border-b border-gray-200 flex items-center justify-between px-4 sm:px-8 shadow-sm transition-all duration-200">

    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>

        <nav class="hidden sm:flex items-center text-sm font-medium">
            <a href="{{ route('admin.courses.index') }}" class="text-gray-500 hover:text-gray-900 transition-colors">
                Dashboard
            </a>

            @php
                $segments = request()->segments();
                $url = url('/');
            @endphp

            @foreach($segments as $index => $segment)
                @php
                    $url .= '/' . $segment;
                    // Skip 'admin' atau ID angka
                    if ($segment === 'admin' || is_numeric($segment)) continue;

                    // Format text
                    $label = Str::title(str_replace('-', ' ', $segment));
                    $isLast = $index === count($segments) - 1;
                @endphp

                <span class="mx-2 text-gray-300">/</span>

                @if($isLast)
                    <span class="text-gray-900 font-semibold">{{ $label }}</span>
                @else
                    <a href="{{ $url }}" class="text-gray-500 hover:text-gray-900 transition-colors">
                        {{ $label }}
                    </a>
                @endif
            @endforeach
        </nav>
    </div>

    <div class="flex items-center gap-4">

        <div class="hidden md:block relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </span>
            <input type="text" class="py-2 pl-10 pr-4 text-sm text-gray-700 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all" placeholder="Search...">
        </div>

        <button class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors rounded-full hover:bg-gray-100">
            <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
        </button>

        <div class="flex items-center gap-3 pl-4 border-l border-gray-200">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-semibold text-gray-900 leading-tight">
                    {{ auth()->user()->name ?? 'Guest User' }}
                </div>
                <div class="text-xs text-gray-500">
                    Administrator
                </div>
            </div>

            <div class="h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold border border-indigo-200 text-sm shadow-sm">
                {{ substr(auth()->user()->name ?? 'G', 0, 2) }}
            </div>
        </div>

    </div>
</header>
