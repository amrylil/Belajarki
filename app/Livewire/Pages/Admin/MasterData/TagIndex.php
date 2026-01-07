<?php
namespace App\Livewire\Pages\Admin\MasterData;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Manage Tags')]
class TagIndex extends Component
{
    use WithPagination;

    public $name;
    public $tagId  = null;
    public $search = '';

    public function updatedSearch()
    {$this->resetPage();}

    public function edit($id)
    {
        $tag         = Tag::findOrFail($id);
        $this->tagId = $tag->id;
        $this->name  = $tag->name;
    }

    public function cancel()
    {
        $this->reset(['name', 'tagId']);
        $this->resetErrorBag();
    }

    public function save()
    {
        // UBAH VALIDASI INI JUGA
        $this->validate([
            'name' => [
                'required',
                'min:2',
                Rule::unique('tags', 'name')->ignore($this->tagId),
            ],
        ]);

        Tag::updateOrCreate(
            ['id' => $this->tagId],
            [
                'name' => $this->name,
                'slug' => Str::slug($this->name),
            ]
        );

        $message = $this->tagId ? 'Tag diperbarui.' : 'Tag dibuat.';
        session()->flash('message', $message);
        $this->cancel();
    }

    public function delete($id)
    {
        $tag = Tag::find($id);
        if ($tag) {
            $tag->delete();
            session()->flash('message', 'Tag dihapus.');
        }
        $this->cancel();
    }

    public function render()
    {
        $tags = Tag::query()
            ->withCount('courses')
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.pages.admin.master-data.tag-index', [
            'tags' => $tags,
        ]);
    }
}
