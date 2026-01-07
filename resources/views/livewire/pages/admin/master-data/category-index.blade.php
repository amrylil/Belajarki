<div class="flex flex-col lg:flex-row gap-6">

    <div class="flex-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center gap-4">
                <h3 class="font-bold text-gray-800 text-lg">Daftar Kategori</h3>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari kategori..." class="border-gray-300 rounded-lg text-sm px-3 py-2 w-full max-w-xs focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-xs uppercase font-semibold text-gray-500">
                    <tr>
                        <th class="px-4 py-3">Nama Kategori</th>
                        <th class="px-4 py-3 text-center">Jumlah Kursus</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50 transition-colors {{ $categoryId === $category->id ? 'bg-indigo-50' : '' }}">
                            <td class="px-4 py-3">
                                <span class="font-semibold text-gray-800">{{ $category->name }}</span>
                                <div class="text-xs text-gray-400">{{ $category->slug }}</div>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-bold">{{ $category->courses_count }}</span>
                            </td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <button wire:click="edit('{{ $category->id }}')" class="text-indigo-600 hover:text-indigo-800 font-medium text-xs">Edit</button>
                                <button wire:click="delete('{{ $category->id }}')" wire:confirm="Yakin hapus? Ini mungkin mempengaruhi kursus terkait." class="text-red-500 hover:text-red-700 font-medium text-xs">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-8 text-center text-gray-400 italic">Tidak ada data ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4 border-t border-gray-100">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/3">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-6">
            <h3 class="font-bold text-gray-800 text-lg mb-4">
                {{ $categoryId ? 'Edit Kategori' : 'Buat Kategori Baru' }}
            </h3>

            <form wire:submit.prevent="save">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" wire:model="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Misal: Web Development">
                    @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg font-medium shadow transition-colors">
                        {{ $categoryId ? 'Update' : 'Simpan' }}
                    </button>

                    @if($categoryId)
                        <button type="button" wire:click="cancel" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                            Batal
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
