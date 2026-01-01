<?php

    use Livewire\Attributes\Layout;
    use Livewire\Volt\Component;

    new #[Layout('layouts.app')] class extends Component
    {
        // Data Dummy Tim
        public function with(): array
        {
            return [
                'team' => [
                    [
                        'name'  => 'Ulil Amry',
                        'role'  => 'Founder & CEO',
                        'image' => 'https://ui-avatars.com/api/?name=Ulil+Amry&background=random&size=200',
                        'bio'   => 'Visionary leader with 10+ years in EdTech and Software Engineering.',
                    ],
                    [
                        'name'  => 'Sarah Wijaya',
                        'role'  => 'Head of Curriculum',
                        'image' => 'https://ui-avatars.com/api/?name=Sarah+Wijaya&background=random&size=200',
                        'bio'   => 'Ex-Google Engineer passionate about democratization of AI education.',
                    ],
                    [
                        'name'  => 'Budi Santoso',
                        'role'  => 'Lead Instructor',
                        'image' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=random&size=200',
                        'bio'   => 'Fullstack specialist focusing on Scalable Backend Systems.',
                    ],
                    [
                        'name'  => 'Jessica Lin',
                        'role'  => 'Community Manager',
                        'image' => 'https://ui-avatars.com/api/?name=Jessica+Lin&background=random&size=200',
                        'bio'   => 'Building a safe and active space for developers to grow together.',
                    ],
                ],
            ];
        }
}?>

<div class="min-h-screen bg-white font-[Poppins] pt-24 pb-20">

    <section class="max-w-5xl mx-auto px-6 text-center mb-24">
        <h4 class="text-indigo-600 font-bold text-sm mb-4 tracking-widest uppercase">TENTANG BELAJARKI</h4>
        <h1 class="text-4xl md:text-6xl font-bold text-slate-900 leading-tight mb-8">
            Membangun Jembatan Menuju <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Masa Depan Teknologi</span>
        </h1>
        <p class="text-slate-500 text-lg max-w-2xl mx-auto leading-relaxed">
            Kami percaya bahwa pendidikan teknologi berkualitas tinggi harus dapat diakses oleh siapa saja, di mana saja. Belajarki hadir untuk mencetak talenta digital siap kerja.
        </p>
    </section>

    <section class="max-w-7xl mx-auto px-6 mb-32">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="grid grid-cols-2 gap-4">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=600&q=80" class="rounded-[2rem] shadow-lg w-full h-64 object-cover transform translate-y-8">
                <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=600&q=80" class="rounded-[2rem] shadow-lg w-full h-64 object-cover">
            </div>
            <div>
                <h2 class="text-3xl font-bold text-slate-800 mb-6">Cerita Kami</h2>
                <div class="prose prose-slate text-slate-500 leading-relaxed space-y-4">
                    <p>
                        Dunia berubah dengan cepat. Teknologi seperti Artificial Intelligence, Cloud Computing, dan Modern Backend Architecture berkembang lebih cepat daripada kurikulum formal.
                    </p>
                    <p>
                        <strong>Belajarki</strong> lahir dari keresahan itu. Kami menyadari adanya kesenjangan (gap) antara apa yang diajarkan di sekolah dengan apa yang dibutuhkan oleh industri saat ini.
                    </p>
                    <p>
                        Misi kami sederhana: Memberikan materi pembelajaran yang <strong>Up-to-date</strong>, <strong>Praktikal</strong>, dan <strong>Relevan</strong> dengan standar industri global. Tidak ada teori membosankan, hanya skill nyata yang bisa Anda gunakan untuk membangun karier impian.
                    </p>
                </div>

                <div class="mt-8 flex gap-8">
                    <div>
                        <h3 class="text-3xl font-bold text-indigo-600">10k+</h3>
                        <p class="text-sm text-slate-500 font-medium">Siswa Aktif</p>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold text-indigo-600">50+</h3>
                        <p class="text-sm text-slate-500 font-medium">Modul Kursus</p>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold text-indigo-600">95%</h3>
                        <p class="text-sm text-slate-500 font-medium">Kepuasan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-24 mb-32 rounded-[3rem] mx-4">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-800 mb-4">Kenapa Memilih Kami?</h2>
                <p class="text-slate-500">Pendekatan kami berbeda. Kami fokus pada hasil nyata.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:-translate-y-1 transition duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Kurikulum Berbasis Proyek</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Lupakan menghafal sintaks. Di sini Anda belajar dengan membangun aplikasi nyata (Real World Apps) dari nol hingga deploy.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:-translate-y-1 transition duration-300">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Teknologi Modern</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Kami mengajarkan stack teknologi yang sedang dicari pasar saat ini: Golang, Rust, Next.js, Docker, Kubernetes, dan LLM.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:-translate-y-1 transition duration-300">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Mentor Praktisi</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Belajar langsung dari mereka yang bekerja di perusahaan teknologi top. Dapatkan insight industri yang tidak ada di buku teks.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 mb-24">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-slate-800 mb-4">Tim Dibalik Layar</h2>
            <p class="text-slate-500">Orang-orang berdedikasi yang membuat pembelajaran ini mungkin.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($team as $member)
                <div class="text-center group">
                    <div class="relative mb-6 inline-block">
                        <div class="absolute inset-0 bg-indigo-200 rounded-full transform translate-x-2 translate-y-2 transition group-hover:translate-x-1 group-hover:translate-y-1"></div>
                        <img src="{{ $member['image'] }}" class="relative w-32 h-32 rounded-full border-4 border-white object-cover shadow-sm z-10" alt="{{ $member['name'] }}">
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">{{ $member['name'] }}</h3>
                    <p class="text-xs font-bold text-indigo-600 uppercase tracking-wide mb-3">{{ $member['role'] }}</p>
                    <p class="text-xs text-slate-500 px-4 leading-relaxed">{{ $member['bio'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-6 text-center mb-12">
        <div class="bg-slate-900 rounded-[2.5rem] p-12 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500 rounded-full mix-blend-overlay filter blur-3xl opacity-20"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-500 rounded-full mix-blend-overlay filter blur-3xl opacity-20"></div>

            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white mb-6">Siap Memulai Perjalanan Anda?</h2>
                <p class="text-slate-300 mb-8 max-w-lg mx-auto">
                    Bergabunglah dengan ribuan siswa lainnya dan mulailah membangun masa depan teknologi Anda hari ini.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('courses.index') }}" wire:navigate class="px-8 py-3 bg-white text-slate-900 rounded-full font-bold hover:bg-slate-100 transition">
                        Lihat Kursus
                    </a>
                    @guest
                        <a href="{{ route('register') }}" wire:navigate class="px-8 py-3 bg-transparent border border-slate-600 text-white rounded-full font-bold hover:bg-slate-800 transition">
                            Daftar Gratis
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

</div>
