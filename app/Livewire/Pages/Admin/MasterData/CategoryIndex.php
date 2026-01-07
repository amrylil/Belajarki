<?php
namespace App\Livewire\Pages\Admin\MasterData;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Manage Categories')]
class CategoryIndex extends Component
{
    use WithPagination;

    // Form Properties
    public $name;
    public $categoryId = null; // Jika null = Mode Create, Jika isi = Mode Edit

    // Filter
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    // --- CRUD LOGIC ---

    public function edit($id)
    {
        $category         = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name       = $category->name;
    }

    public function cancel()
    {
        $this->reset(['name', 'categoryId']);
        $this->resetErrorBag();
    }

    public function save()
    {
        // UBAH BAGIAN VALIDASI INI
        $this->validate([
            'name' => [
                'required',
                'min:3',
                // Rule ini aman untuk UUID dan Postgres
                Rule::unique('categories', 'name')->ignore($this->categoryId),
            ],
        ]);

        Category::updateOrCreate(
            ['id' => $this->categoryId],
            [
                'name' => $this->name,
                'slug' => Str::slug($this->name),
            ]
        );

        $message = $this->categoryId ? 'Kategori diperbarui.' : 'Kategori dibuat.';
        session()->flash('message', $message);

        $this->cancel();
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            session()->flash('message', 'Kategori dihapus.');
        }
        $this->cancel();
    }

    public function render()
    {
        $categories = Category::query()
            ->withCount('courses') // Menghitung jumlah course per kategori
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.pages.admin.master-data.category-index', [
            'categories' => $categories,
        ]);
    }
}
