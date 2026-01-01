<?php
namespace App\Livewire\Pages\Course;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Show extends Component
{
    public Course $course;
    public $isEnrolled = false;

    // Mount dijalankan saat halaman pertama kali dibuka
    public function mount($slug)
    {
        // Cari course berdasarkan slug, sekalian ambil modul & lessonnya
        $this->course = Course::with(['modules.lessons', 'category', 'tags'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Cek apakah user sudah login & sudah enroll course ini
        if (Auth::check()) {
            $this->isEnrolled = Enrollment::where('user_id', Auth::id())
                ->where('course_id', $this->course->id)
                ->exists();
        }
    }

    // LOGIC: User Klik Tombol "Start Learning" / "Enroll Now"
    public function joinCourse()
    {
        // 1. Cek Login
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Jika belum enroll, buat data enrollment baru
        if (! $this->isEnrolled) {
            Enrollment::create([
                'user_id'      => Auth::id(),
                'course_id'    => $this->course->id,
                'is_completed' => false,
            ]);
        }

        // 3. Redirect ke halaman belajar (Lesson pertama)
        // Kita cari lesson pertama dari modul pertama
        $firstLesson = $this->course->modules->first()?->lessons->first();

        if ($firstLesson) {
            return redirect()->route('learning.player', [
                'courseSlug' => $this->course->slug,
                'lessonId'   => $firstLesson->id,
            ]);
        } else {
            // Jaga-jaga kalau course belum ada materinya
            session()->flash('error', 'Materi kursus belum tersedia.');
        }
    }

    public function render()
    {
        return view('livewire.pages.course.show');
    }
}
