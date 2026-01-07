<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin BelajarKi' }}</title>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">

    <div class="h-screen flex overflow-hidden" x-data="{ sidebarOpen: false }">

        <livewire:layout.sidebar />

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <livewire:layout.header_admin />

            <main class="flex-1 overflow-y-auto p-4 sm:p-8">
                {{ $slot }}
            </main>

        </div>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</body>
</html>
