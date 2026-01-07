<?php
namespace App\Livewire\Pages\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Manage Admins')]
class AdminIndex extends Component
{
    use WithPagination;

    public $name, $email, $password;
    public $userId = null;
    public $search = '';

    public function updatedSearch()
    {$this->resetPage();}

    public function edit($id)
    {
        $user           = User::findOrFail($id);
        $this->userId   = $user->id;
        $this->name     = $user->name;
        $this->email    = $user->email;
        $this->password = ''; // Password dikosongkan saat edit (keamanan)
    }

    public function cancel()
    {
        $this->reset(['name', 'email', 'password', 'userId']);
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate([
            'name'     => 'required|min:3',
            'email'    => ['required', 'email', Rule::unique('users', 'email')->ignore($this->userId)],
            'password' => $this->userId ? 'nullable|min:6' : 'required|min:6',
        ]);

        $data = [
            'name'  => $this->name,
            'email' => $this->email,
            'role'  => 'admin',
        ];

        // Hanya update password jika diisi
        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->userId], $data);

        session()->flash('message', $this->userId ? 'Admin updated.' : 'Admin created.');
        $this->cancel();
    }

    public function delete($id)
    {
        if ($id === auth()->id()) {
            return; // Mencegah hapus diri sendiri
        }
        User::find($id)->delete();
        session()->flash('message', 'Admin deleted.');
    }

    public function render()
    {
        $admins = User::where('role', 'admin')
            ->when($this->search, fn($q) => $q->where('name', 'like', "%$this->search%"))
            ->latest()
            ->paginate(10);

        return view('livewire.pages.admin.user.admin-index', ['admins' => $admins]);
    }
}
