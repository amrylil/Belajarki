<div class="max-w-5xl mx-auto py-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                {{ $course ? 'Edit Course' : 'Create New Course' }}
            </h2>
            <p class="text-sm text-gray-500">Lengkapi detail kursus, kategori, dan kurikulum.</p>
        </div>
        <a href="{{ route('admin.courses.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">&larr; Kembali</a>
    </div>

    <form wire:submit.prevent="save">

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-8">
            <h3 class="text-lg font-bold mb-6 pb-2 border-b border-gray-100 text-gray-800">Informasi Dasar</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Thumbnail Kursus</label>
                    <div class="flex items-start gap-5 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <div class="w-40 h-24 bg-gray-200 rounded overflow-hidden flex-shrink-0 relative border">
                            @if ($thumbnail)
                                <img src="{{ $thumbnail->temporaryUrl() }}" class="w-full h-full object-cover">
                            @elseif ($old_thumbnail)
                                <img src="{{ asset('storage/' . $old_thumbnail) }}" class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400 text-xs">No Image</div>
                            @endif
                            <div wire:loading wire:target="thumbnail" class="absolute inset-0 bg-white/80 flex items-center justify-center text-xs text-blue-600 font-bold">Uploading...</div>
                        </div>
                        <div class="flex-1">
                            <input type="file" wire:model="thumbnail" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 mb-2 cursor-pointer">
                            <p class="text-xs text-gray-500">Format: JPG/PNG. Maks 2MB.</p>
                            @error('thumbnail') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Kursus</label>
                    <input type="text" wire:model="title" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2 border" placeholder="Masukkan judul kursus...">
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select wire:model="category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2 border bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tingkat Kesulitan</label>
                    <select wire:model="level" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2 border bg-white">
                        <option value="beginner">Pemula (Beginner)</option>
                        <option value="intermediate">Menengah (Intermediate)</option>
                        <option value="advanced">Mahir (Advanced)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga (IDR)</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2 text-gray-500 text-sm">Rp</span>
                        <input type="number" wire:model="price" class="w-full pl-10 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2 border" placeholder="0">
                    </div>
                </div>

                <div class="flex items-end pb-2">
                    <label class="flex items-center gap-3 cursor-pointer select-none p-2 border rounded-lg hover:bg-gray-50 w-full">
                        <input type="checkbox" wire:model="is_published" class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                        <span class="font-medium text-gray-700">Publikasikan Kursus?</span>
                    </label>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tags / Topik Terkait</label>
                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50 h-40 overflow-y-auto custom-scrollbar">
                        @if($availableTags->isEmpty())
                            <p class="text-gray-400 text-sm italic">Belum ada tags di database.</p>
                        @else
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                @foreach($availableTags as $tag)
                                    <label class="flex items-center space-x-2 cursor-pointer bg-white px-2 py-1.5 rounded border border-gray-200 hover:border-blue-300 transition-colors">
                                        <input type="checkbox" wire:model="selectedTags" value="{{ $tag->id }}" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm text-gray-600 select-none">{{ $tag->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @error('selectedTags') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

            </div>
        </div>

        <div class="space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Kurikulum Materi</h3>
                <button type="button" wire:click="addModule" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-black transition-colors shadow">
                    + Tambah Modul
                </button>
            </div>

            @foreach($modules as $mIndex => $module)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" wire:key="module-{{ $mIndex }}">
                    <div class="bg-gray-50 p-4 border-b border-gray-200 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
                        <div class="flex-1 w-full">
                            <span class="text-xs font-bold text-blue-600 uppercase tracking-wider block mb-1">Modul {{ $mIndex + 1 }}</span>
                            <input type="text" wire:model="modules.{{ $mIndex }}.title" placeholder="Nama Modul..." class="w-full bg-transparent border-0 border-b-2 border-transparent focus:border-blue-500 focus:ring-0 px-0 py-1 font-bold text-lg text-gray-800 placeholder-gray-400">
                            @error("modules.{$mIndex}.title") <span class="text-red-500 text-xs block mt-1">Wajib diisi</span> @enderror
                        </div>
                        <button type="button" wire:click="removeModule({{ $mIndex }})" wire:confirm="Hapus modul ini?" class="text-red-500 hover:bg-red-50 hover:text-red-700 px-3 py-1.5 rounded text-sm font-medium transition-colors">
                            &times; Hapus
                        </button>
                    </div>

                    <div class="p-6 space-y-6">
                        @foreach($module['lessons'] as $lIndex => $lesson)
                            <div class="pl-4 border-l-4 border-gray-200 hover:border-blue-400 transition-colors" wire:key="lsn-{{ $mIndex }}-{{ $lIndex }}">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xs font-bold bg-gray-100 text-gray-600 px-2 py-0.5 rounded">Materi {{ $lIndex + 1 }}</span>
                                    <button type="button" wire:click="removeLesson({{ $mIndex }}, {{ $lIndex }})" class="text-gray-400 hover:text-red-500 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>

                                <div class="grid gap-3">
                                    <input type="text" wire:model="modules.{{ $mIndex }}.lessons.{{ $lIndex }}.title" placeholder="Judul Materi" class="w-full border-gray-300 rounded text-sm focus:ring-blue-500 focus:border-blue-500">

                                    <div class="border border-gray-200 rounded-md">
                                        <x-quill-editor wire:model="modules.{{ $mIndex }}.lessons.{{ $lIndex }}.content" />
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="text-xs text-gray-500">Durasi (Menit):</span>
                                        <input type="number" wire:model="modules.{{ $mIndex }}.lessons.{{ $lIndex }}.duration" class="w-20 border-gray-300 rounded text-sm p-1 text-center">
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <button type="button" wire:click="addLesson({{ $mIndex }})" class="w-full py-3 border-2 border-dashed border-gray-300 rounded-lg text-gray-500 text-sm hover:border-blue-500 hover:text-blue-600 hover:bg-blue-50 transition-all flex justify-center items-center gap-2">
                            <span>+</span> Tambah Materi
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10 flex justify-end sticky bottom-6 z-10">
            <div class="bg-white p-2 rounded-lg shadow-lg border border-gray-100 flex gap-3">
                <a href="{{ route('admin.courses.index') }}" class="px-6 py-2.5 rounded-lg text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium transition-colors">Batal</a>
                <button type="submit" class="px-8 py-2.5 rounded-lg text-white bg-blue-600 hover:bg-blue-700 font-bold shadow-md transition-colors flex items-center gap-2">
                    <span wire:loading.remove wire:target="save">Simpan Kursus</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </button>
            </div>
        </div>

    </form>
</div>
