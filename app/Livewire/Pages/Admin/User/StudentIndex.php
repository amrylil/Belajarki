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
#[Title('Manage Students')]
class StudentIndex extends Component
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
        $this->password = '';
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
            'role'  => 'student', // Force role Student
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->userId], $data);

        session()->flash('message', $this->userId ? 'Student updated.' : 'Student created.');
        $this->cancel();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Student deleted.');
    }

    public function render()
    {
        // Ambil Student + Hitung Enrollment Mereka
        $students = User::where('role', 'student')
            ->withCount('enrollments') // <-- MONITORING ENROLL
            ->when($this->search, fn($q) => $q->where('name', 'like', "%$this->search%")->orWhere('email', 'like', "%$this->search%"))
            ->latest()
            ->paginate(10);

        return view('livewire.pages.admin.user.student-index', ['students' => $students]);
    }
}
