<?php
namespace App\Livewire\Pages\Learning;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

// Kita pakai layout kosong/khusus biar fokus belajar (opsional)
#[Layout('layouts.app')]
class Player extends Component
{
    public Course $course;
    public Lesson $currentLesson;

    public $previousLessonId = null;
    public $nextLessonId     = null;

    public function mount($course, $lesson)
    {
        // 1. Ambil Data Course & Syllabus
        $this->course = Course::with(['modules.lessons'])
            ->where('slug', $course)
            ->firstOrFail();

        // 2. CEK KEAMANAN: Apakah user sudah enroll?
        $hasAccess = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $this->course->id)
            ->exists();

        if (! $hasAccess) {
            abort(403, 'Anda belum mendaftar di kursus ini.');
        }

        // 3. Ambil Lesson yang sedang dibuka
        $this->currentLesson = Lesson::where('id', $lesson)->firstOrFail();

        // 4. Setup Navigasi (Next/Prev Button)
        $this->setupNavigation();
    }

    public function setupNavigation()
    {
        // Ambil semua lesson dalam course ini, urutkan sesuai modul & sort lesson
        // Ini teknik "Flatten" collection biar jadi satu list panjang
        $allLessons = $this->course->modules->flatMap(function ($module) {
            return $module->lessons;
        });

        // Cari index lesson saat ini
        $currentIndex = $allLessons->search(function ($item) {
            return $item->id === $this->currentLesson->id;
        });

        // Tentukan ID lesson sebelum dan sesudahnya
        $this->previousLessonId = ($currentIndex > 0) ? $allLessons[$currentIndex - 1]->id : null;
        $this->nextLessonId     = ($currentIndex < $allLessons->count() - 1) ? $allLessons[$currentIndex + 1]->id : null;
    }

    public function render()
    {
        return view('livewire.pages.learning.player');
    }
}
