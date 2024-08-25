<?php

use App\MoonShine\Controllers\ChapterController;
use App\MoonShine\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::middleware('moonshine')->group(function () {
    Route::middleware(config('moonshine.auth.middleware', []))->group(function () {
        
        Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/{slug}', [CourseController::class, 'detail'])->name('courses.detail');

        Route::get('/courses/{slug}/chapters/{chapterId}', [ChapterController::class, 'detail'])
            ->whereNumber('chapterId')
            ->name('chapters.detail');
    });
});