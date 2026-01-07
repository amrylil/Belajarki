<?php

use App\Livewire\Pages\Admin\Course\CourseForm;
use App\Livewire\Pages\Admin\Course\Index;
use App\Livewire\Pages\Admin\Dashboard;
use App\Livewire\Pages\Admin\Enrollment\EnrollmentIndex;
use App\Livewire\Pages\Admin\MasterData\CategoryIndex;
use App\Livewire\Pages\Admin\MasterData\TagIndex;
use App\Livewire\Pages\Admin\User\AdminIndex;
use App\Livewire\Pages\Admin\User\StudentIndex;
use App\Livewire\Pages\Course\Index as CourseIndex;
use App\Livewire\Pages\Course\Show as CourseShow;
use App\Livewire\Pages\Learning\Player as LearningPlayer;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// --- 1. PUBLIC ROUTES (Bisa diakses siapa saja) ---
Volt::route('/', 'pages.home')->name('home');
Volt::route('/kategori', 'pages.category.index')->name('category.index');
Volt::route('/tentang', 'pages.about')->name('about');

Route::get('/fix-storage', function () {
    // Menjalankan perintah storage:link lewat kode
    Artisan::call('storage:link');
    return 'Storage Link Berhasil Dibuat! Cek website Anda.';
});
// Route List Course (Public)
Route::get('/courses', CourseIndex::class)->name('courses.index');
// Route Detail Course (Public)
Route::get('/courses/{slug}', CourseShow::class)->name('courses.show');

// --- 2. AUTHENTICATED COMMON ROUTES ---

// Redirect Pintar untuk Dashboard
// Menggantikan Route::view('dashboard') bawaan Breeze
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    // Jika student, arahkan ke Home atau halaman khusus student
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// --- 3. ADMIN ROUTES (Protected by 'role:admin') ---
Route::middleware(['auth', 'verified', 'role:admin']) // <--- Middleware dipasang disini
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', Dashboard::class)->name('dashboard');

        // Course Management
        Route::get('/courses', Index::class)->name('courses.index');
        Route::get('/courses/create', CourseForm::class)->name('courses.create');
        Route::get('/courses/{id}/edit', CourseForm::class)->name('courses.edit');

        // Master Data
        Route::get('/master/categories', CategoryIndex::class)->name('master.categories');
        Route::get('/master/tags', TagIndex::class)->name('master.tags');

        // Monitoring & Users
        Route::get('/enrollments', EnrollmentIndex::class)->name('enrollments.index');
        Route::get('/users/admins', AdminIndex::class)->name('users.admins');
        Route::get('/users/students', StudentIndex::class)->name('users.students');

    });

// --- 4. STUDENT / LEARNING ROUTES (Protected by 'role:student') ---
Route::middleware(['auth', 'verified', 'role:student']) // <--- Middleware Student
    ->group(function () {

        // Halaman Player Belajar
        Route::get('/learning/{courseSlug}/{lessonId}', LearningPlayer::class)
            ->name('learning.player');

        // Anda bisa menambahkan route khusus student lainnya disini
        // Contoh: Route::get('/my-courses', ...);
    });

require __DIR__ . '/auth.php';
