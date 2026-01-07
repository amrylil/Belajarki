<?php
namespace App\Livewire\Pages\Admin\Course;

use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Course Management')]
class Index extends Component
{
    use WithPagination;

    public $search       = '';
    public $filterStatus = ''; // 'published', 'draft', atau ''

    // Reset pagination saat search berubah
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Fungsi Delete
    public function delete($id)
    {
        $course = Course::find($id);

        if ($course) {
            // Hapus thumbnail jika ada
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }

            $course->delete();
            session()->flash('message', 'Kursus berhasil dihapus.');
        }
    }

    // Fitur Toggle Status Cepat (Optional)
    public function toggleStatus($id)
    {
        $course = Course::find($id);
        if ($course) {
            $course->is_published = ! $course->is_published;
            $course->save();
        }
    }

    public function render()
    {
        // Query Dasar
        $query = Course::query()
            ->withCount(['modules', 'enrollments']) // Hitung jumlah modul & murid
            ->when($this->search, function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterStatus !== '', function ($q) {
                $isPublished = $this->filterStatus === 'published';
                $q->where('is_published', $isPublished);
            });

        // Data untuk Stats Cards (Atas)
        $totalCourses   = Course::count();
        $publishedCount = Course::where('is_published', true)->count();
        $draftCount     = Course::where('is_published', false)->count();
        $premiumCount   = Course::where('price', '>', 0)->count(); // Contoh statistik tambahan

        return view('livewire.pages.admin.course.index', [
            'courses' => $query->latest()->paginate(10),
            'stats'   => [
                'total'     => $totalCourses,
                'published' => $publishedCount,
                'draft'     => $draftCount,
                'premium'   => $premiumCount,
            ],
        ]);
    }
}
