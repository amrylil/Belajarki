<div class="flex flex-col lg:flex-row gap-6">
    <div class="flex-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-gray-800">Daftar Siswa</h3>
                    <p class="text-xs text-gray-500">Monitor siswa yang terdaftar</p>
                </div>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari siswa..." class="border-gray-300 rounded-lg text-sm px-3 py-1">
            </div>
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="px-4 py-3">Siswa</th>
                        <th class="px-4 py-3 text-center">Kursus Diambil</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($students as $student)
                    <tr class="hover:bg-gray-50 {{ $userId === $student->id ? 'bg-indigo-50' : '' }}">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                                    {{ substr($student->name, 0, 2) }}
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">{{ $student->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $student->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($student->enrollments_count > 0)
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-bold">
                                    {{ $student->enrollments_count }} Kursus
                                </span>
                            @else
                                <span class="text-gray-400 text-xs italic">Belum ada</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <button wire:click="edit('{{ $student->id }}')" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">Edit</button>
                            <button wire:click="delete('{{ $student->id }}')" wire:confirm="Hapus siswa ini? History belajarnya akan hilang." class="text-red-500 hover:text-red-700 text-xs font-medium">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">{{ $students->links() }}</div>
        </div>
    </div>

    <div class="w-full lg:w-1/3">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-6">
            <h3 class="font-bold text-gray-800 mb-4">{{ $userId ? 'Edit Siswa' : 'Tambah Siswa' }}</h3>
            <form wire:submit.prevent="save" class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" wire:model="name" class="w-full border-gray-300 rounded-lg text-sm">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Email</label>
                    <input type="email" wire:model="email" class="w-full border-gray-300 rounded-lg text-sm">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Password {{ $userId ? '(Opsional)' : '' }}</label>
                    <input type="password" wire:model="password" class="w-full border-gray-300 rounded-lg text-sm">
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="flex gap-2 pt-2">
                    <button type="submit" class="flex-1 bg-blue-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-blue-700">Simpan</button>
                    @if($userId) <button type="button" wire:click="cancel" class="px-4 bg-gray-200 text-gray-700 rounded-lg text-sm">Batal</button> @endif
                </div>
            </form>
        </div>
    </div>
</div>
