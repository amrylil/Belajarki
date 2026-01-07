<?php
namespace App\Livewire\Pages\Admin\Course;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class CourseForm extends Component
{
    use WithFileUploads;

    public ?Course $course = null;

    // --- 1. Course Properties ---
    public $title;
    public $price;
    public $level        = 'beginner';
    public $is_published = false;

                               // --- 2. Relations (Category & Tags) ---
    public $category_id  = ''; // Untuk Single Select (UUID)
    public $selectedTags = []; // Untuk Multi Select (Array UUID)

    // --- 3. Thumbnail ---
    public $thumbnail;
    public $old_thumbnail;

    // --- 4. Builder Data ---
    public $modules          = [];
    public $deletedModuleIds = [];
    public $deletedLessonIds = [];

    public function mount($id = null)
    {
        if ($id) {
            // Edit Mode: Load Course + Tags + Modules + Lessons
            $this->course = Course::with(['modules.lessons', 'tags'])->findOrFail($id);

            // Fill Basic Data
            $this->title         = $this->course->title;
            $this->price         = $this->course->price;
            $this->level         = $this->course->level;
            $this->is_published  = (bool) $this->course->is_published;
            $this->old_thumbnail = $this->course->thumbnail;

            // Fill Category
            $this->category_id = $this->course->category_id;

            // Fill Tags (Ambil ID-nya saja masukkan ke array)
            $this->selectedTags = $this->course->tags->pluck('id')->map(fn($id) => (string) $id)->toArray();

            // Fill Builder (Modules & Lessons)
            foreach ($this->course->modules as $mod) {
                $lessonsData = [];
                foreach ($mod->lessons as $lesson) {
                    $lessonsData[] = [
                        'id' => $lesson->id, 'title' => $lesson->title, 'content' => $lesson->content, 'duration' => $lesson->duration,
                    ];
                }
                $this->modules[] = ['id' => $mod->id, 'title' => $mod->title, 'lessons' => $lessonsData];
            }
        } else {
            // Create Mode: Default 1 modul kosong
            $this->addModule();
        }
    }

    // --- Builder Logic (Tambah/Hapus Baris) ---

    public function addModule()
    {
        $this->modules[] = ['id' => null, 'title' => '', 'lessons' => []];
    }

    public function removeModule($index)
    {
        $module = $this->modules[$index];
        if (! empty($module['id'])) {
            $this->deletedModuleIds[] = $module['id'];
        }
        unset($this->modules[$index]);
        $this->modules = array_values($this->modules);
    }

    public function addLesson($moduleIndex)
    {
        $this->modules[$moduleIndex]['lessons'][] = ['id' => null, 'title' => '', 'content' => '', 'duration' => 0];
    }

    public function removeLesson($moduleIndex, $lessonIndex)
    {
        $lesson = $this->modules[$moduleIndex]['lessons'][$lessonIndex];
        if (! empty($lesson['id'])) {
            $this->deletedLessonIds[] = $lesson['id'];
        }
        unset($this->modules[$moduleIndex]['lessons'][$lessonIndex]);
        $this->modules[$moduleIndex]['lessons'] = array_values($this->modules[$moduleIndex]['lessons']);
    }

    // --- SAVE LOGIC ---

    public function save()
    {
        $this->validate([
            'title'                     => 'required|min:3',
            'thumbnail'                 => 'nullable|image|max:2048',
            'category_id'               => 'required|exists:categories,id', // Validasi Kategori
            'selectedTags'              => 'array',
            'selectedTags.*'            => 'exists:tags,id', // Validasi Tags
            'modules.*.title'           => 'required',
            'modules.*.lessons.*.title' => 'required',
        ]);

        // 1. Siapkan Data Course
        $data = [
            'title'        => $this->title,
            'slug'         => Str::slug($this->title),
            'price'        => $this->price,
            'level'        => $this->level,
            'is_published' => $this->is_published,
            'category_id'  => $this->category_id, // Masukkan ID Kategori yg dipilih user
        ];

        // 2. Upload Thumbnail
        if ($this->thumbnail) {
            if ($this->course && $this->course->thumbnail) {
                Storage::disk('public')->delete($this->course->thumbnail);
            }
            $data['thumbnail'] = $this->thumbnail->store('courses', 'public');
        }

        // 3. Simpan ke DB
        if ($this->course) {
            $this->course->update($data);
        } else {
            $this->course = Course::create($data);
        }

        // 4. SYNC TAGS (Penting!)
        // Ini otomatis menambah tag baru & menghapus tag yang di-uncheck
        $this->course->tags()->sync($this->selectedTags);

        // 5. Bersihkan item yang dihapus di Builder
        if (! empty($this->deletedLessonIds)) {
            Lesson::destroy($this->deletedLessonIds);
        }

        if (! empty($this->deletedModuleIds)) {
            Module::destroy($this->deletedModuleIds);
        }

        // 6. Simpan Modules & Lessons
        foreach ($this->modules as $mIndex => $modData) {
            $module = $this->course->modules()->updateOrCreate(
                ['id' => $modData['id'] ?? null],
                ['title' => $modData['title'], 'sort' => $mIndex + 1]
            );

            foreach ($modData['lessons'] as $lIndex => $lessData) {
                $module->lessons()->updateOrCreate(
                    ['id' => $lessData['id'] ?? null],
                    [
                        'title' => $lessData['title'], 'content' => $lessData['content'], 'duration' => $lessData['duration'],
                        'type'  => 'text', 'sort'                => $lIndex + 1, 'is_preview'        => false,
                    ]
                );
            }
        }

        session()->flash('message', 'Course berhasil disimpan!');
        return redirect()->route('admin.courses.index');
    }

    public function render()
    {
        // Kirim data dropdown ke View
        return view('livewire.pages.admin.course.course-form', [
            'categories'    => Category::orderBy('name')->get(),
            'availableTags' => Tag::orderBy('name')->get(),
        ]);
    }
}
