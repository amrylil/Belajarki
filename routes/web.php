<?php

use App\Livewire\Pages\Course\Index as CourseIndex;
use App\Livewire\Pages\Course\Show as CourseShow;
use App\Livewire\Pages\Learning\Player as LearningPlayer;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/', 'pages.home')->name('pages');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/courses', CourseIndex::class)->name('courses.index');
Route::get('/courses/{slug}', CourseShow::class)->name('courses.show');

// Halaman Belajar (Harus Login & Verified)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/learning/{course}/{lesson}', LearningPlayer::class)->name('learning.player');
});

require __DIR__ . '/auth.php';
