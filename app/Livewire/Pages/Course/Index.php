<?php
namespace App\Livewire\Pages\Course;

use App\Models\Category;
use App\Models\Course;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $selectedCategory = null;

    public function filterByCategory($slug)
    {
        $this->selectedCategory = $slug;
        $this->resetPage(); // Reset ke halaman 1 saat filter berubah
    }

    public function render()
    {
        $courses = Course::query()
            ->with(['category', 'tags']) // Eager load biar ringan
            ->where('is_published', true)
            ->when($this->selectedCategory, function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', $this->selectedCategory);
                });
            })
            ->latest()
            ->paginate(9);

        $categories = Category::has('courses')->get(); // Ambil kategori yg ada kursusnya aja

        return view('livewire.pages.course.index', [
            'courses'    => $courses,
            'categories' => $categories,
        ]);
    }
}
