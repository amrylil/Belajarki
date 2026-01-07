<div class="flex flex-col lg:flex-row gap-6">
    <div class="flex-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center gap-4">
                <h3 class="font-bold text-gray-800 text-lg">Daftar Tags</h3>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari tag..." class="border-gray-300 rounded-lg text-sm px-3 py-2 w-full max-w-xs focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="p-4 grid grid-cols-2 sm:grid-cols-3 gap-3">
                @forelse($tags as $tag)
                    <div class="flex items-center justify-between p-3 rounded-lg border border-gray-100 bg-gray-50 hover:border-blue-300 transition-colors {{ $tagId === $tag->id ? 'ring-2 ring-blue-500 bg-blue-50' : '' }}">
                        <div class="flex flex-col overflow-hidden">
                            <span class="font-semibold text-gray-700 truncate" title="{{ $tag->name }}"># {{ $tag->name }}</span>
                            <span class="text-xs text-gray-400">{{ $tag->courses_count }} Kursus</span>
                        </div>
                        <div class="flex gap-1">
                            <button wire:click="edit('{{ $tag->id }}')" class="p-1 text-blue-600 hover:bg-blue-100 rounded">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            </button>
                            <button wire:click="delete('{{ $tag->id }}')" wire:confirm="Hapus Tag ini?" class="p-1 text-red-500 hover:bg-red-100 rounded">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8 text-gray-400 italic">Belum ada tags.</div>
                @endforelse
            </div>

            <div class="p-4 border-t border-gray-100">
                {{ $tags->links() }}
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/3">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-6">
            <h3 class="font-bold text-gray-800 text-lg mb-4">
                {{ $tagId ? 'Edit Tag' : 'Buat Tag Baru' }}
            </h3>

            <form wire:submit.prevent="save">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Tag</label>
                    <div class="flex items-center">
                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">#</span>
                        <input type="text" wire:model="name" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" placeholder="Laravel">
                    </div>
                    @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium shadow transition-colors">
                        {{ $tagId ? 'Update' : 'Simpan' }}
                    </button>

                    @if($tagId)
                        <button type="button" wire:click="cancel" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                            Batal
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
