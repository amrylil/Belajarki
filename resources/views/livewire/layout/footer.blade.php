<?php

    use Livewire\Volt\Component;

    new class extends Component
    {
        // Tidak ada logic khusus untuk footer saat ini
}; ?>

<footer class="border-t border-slate-200 pt-16 px-6 pb-10 bg-slate-100 text-slate-600 font-[Poppins]">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between gap-10">

        <div class="max-w-xs">
            <span class="text-xl font-bold text-slate-800">Logo</span>
            <p class="text-xs text-slate-500 mt-4 leading-relaxed">
                Our vision is to provide convenience and help increase your sales business.
            </p>

            <div class="flex gap-3 mt-6">
                <a href="#" class="w-8 h-8 bg-white rounded-full shadow-sm flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:shadow-md transition">
                    <span class="text-xs font-bold">FB</span>
                </a>
                <a href="#" class="w-8 h-8 bg-white rounded-full shadow-sm flex items-center justify-center text-slate-400 hover:text-sky-500 hover:shadow-md transition">
                    <span class="text-xs font-bold">TW</span>
                </a>
                <a href="#" class="w-8 h-8 bg-white rounded-full shadow-sm flex items-center justify-center text-slate-400 hover:text-pink-600 hover:shadow-md transition">
                    <span class="text-xs font-bold">IG</span>
                </a>
            </div>
        </div>

        <div class="flex flex-wrap gap-12 text-xs">
            <div class="flex flex-col gap-4">
                <span class="font-bold text-slate-800 text-sm">About</span>
                <a href="#" class="hover:text-slate-900 transition">How it works</a>
                <a href="#" class="hover:text-slate-900 transition">Featured</a>
                <a href="#" class="hover:text-slate-900 transition">Partnership</a>
                <a href="#" class="hover:text-slate-900 transition">Business Relation</a>
            </div>

            <div class="flex flex-col gap-4">
                <span class="font-bold text-slate-800 text-sm">Community</span>
                <a href="#" class="hover:text-slate-900 transition">Events</a>
                <a href="#" class="hover:text-slate-900 transition">Blog</a>
                <a href="#" class="hover:text-slate-900 transition">Podcast</a>
                <a href="#" class="hover:text-slate-900 transition">Invite a Friend</a>
            </div>

            <div class="flex flex-col gap-4">
                <span class="font-bold text-slate-800 text-sm">Socials</span>
                <a href="#" class="hover:text-slate-900 transition">Discord</a>
                <a href="#" class="hover:text-slate-900 transition">Instagram</a>
                <a href="#" class="hover:text-slate-900 transition">Twitter</a>
                <a href="#" class="hover:text-slate-900 transition">Facebook</a>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto mt-12 pt-8 border-t border-slate-200 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] text-slate-400">
        <p>&copy; {{ date('Y') }} Company Name. All rights reserved.</p>
        <div class="flex gap-6">
            <a href="#" class="hover:text-slate-600">Privacy & Policy</a>
            <a href="#" class="hover:text-slate-600">Terms & Condition</a>
        </div>
    </div>
</footer>
