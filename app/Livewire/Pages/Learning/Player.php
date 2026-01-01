<?php
namespace App\Livewire\Pages\Learning;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Player extends Component
{
    public $courseData;
    public $lessonData;

    public $nextLessonId = null;
    public $prevLessonId = null;

    // TERIMA PARAMETER DENGAN NAMA BARU
    public function mount($courseSlug, $lessonId)
    {
        // Debugging (Sekarang pasti muncul karena Laravel tidak mencegat lagi)
        // dd($courseSlug, $lessonId);

        // 1. Cari Course Manual berdasarkan SLUG
        $this->courseData = Course::with(['modules.lessons'])
            ->where('slug', $courseSlug)
            ->firstOrFail();

        // 2. Cari Lesson Manual berdasarkan ID
        $this->lessonData = Lesson::where('id', $lessonId)->firstOrFail();

        // 3. Setup Navigasi
        $this->setupNavigation();
    }

    public function setupNavigation()
    {
        $allLessons   = $this->courseData->modules->flatMap->lessons;
        $currentIndex = $allLessons->search(fn($l) => $l->id === $this->lessonData->id);

        if ($currentIndex !== false) {
            $this->prevLessonId = $currentIndex > 0 ? $allLessons[$currentIndex - 1]->id : null;
            $this->nextLessonId = $currentIndex < $allLessons->count() - 1 ? $allLessons[$currentIndex + 1]->id : null;
        }
    }

    public function goToLesson($targetLessonId)
    {
        // Redirect harus sesuai nama parameter di web.php
        return redirect()->route('learning.player', [
            'courseSlug' => $this->courseData->slug, // Sesuaikan key
            'lessonId'   => $targetLessonId,         // Sesuaikan key
        ]);
    }

    public function render()
    {
        return view('livewire.pages.learning.player', [
            'course'        => $this->courseData,
            'currentLesson' => $this->lessonData,
        ]);
    }
}
