<?php
namespace App\Livewire\Pages\Admin\Enrollment;

use App\Models\Enrollment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Enrollment History')]
class EnrollmentIndex extends Component
{
    use WithPagination;

    public $search       = '';
    public $filterStatus = ''; // 'completed', 'active', ''

    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Hanya fitur delete untuk maintenance/cleanup
    public function delete($id)
    {
        $enrollment = Enrollment::find($id);
        if ($enrollment) {
            $enrollment->delete();
            session()->flash('message', 'Data pendaftaran berhasil dihapus.');
        }
    }

    public function render()
    {
        // Query dengan Relasi User dan Course
        $query = Enrollment::query()
            ->with(['user', 'course'])
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    // Cari berdasarkan Nama Siswa ATAU Judul Kursus
                    $sub->whereHas('user', fn($u) => $u->where('name', 'like', '%' . $this->search . '%'))
                        ->orWhereHas('course', fn($c) => $c->where('title', 'like', '%' . $this->search . '%'));
                });
            })
            ->when($this->filterStatus !== '', function ($q) {
                if ($this->filterStatus === 'completed') {
                    $q->where('is_completed', true);
                } elseif ($this->filterStatus === 'active') {
                    $q->where('is_completed', false);
                }
            });

        // Hitung Statistik
        $stats = [
            'total'     => Enrollment::count(),
            'active'    => Enrollment::where('is_completed', false)->count(),
            'completed' => Enrollment::where('is_completed', true)->count(),
            // Hitung Completion Rate (Persentase)
            'rate'      => Enrollment::count() > 0
                ? round((Enrollment::where('is_completed', true)->count() / Enrollment::count()) * 100)
                : 0,
        ];

        return view('livewire.pages.admin.enrollment.enrollment-index', [
            'enrollments' => $query->latest()->paginate(10),
            'stats'       => $stats,
        ]);
    }
}
