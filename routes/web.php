<?php

use App\MoonShine\Controllers\ChapterController;
use App\MoonShine\Controllers\CourseController;
use App\MoonShine\Controllers\PresentationController;
use Illuminate\Support\Facades\Route;

Route::middleware('moonshine')->group(function () {
    Route::middleware(config('moonshine.auth.middleware', []))->group(function () {

        Route::prefix('courses')->group(function() {
            Route::get('/', [CourseController::class, 'index'])->name('courses.index');
            Route::get('/{slug}', [CourseController::class, 'detail'])->name('courses.detail');
    
            Route::get('/{slug}/chapters/{chapterId}', [ChapterController::class, 'detail'])
                ->whereNumber('chapterId')
                ->name('chapters.detail');
            
            Route::get('/{slug}/chapters/{chapterId}/presentations/{presentationId}', [PresentationController::class, 'detail'])
                ->whereNumber('presentationId')
                ->name('presentations.detail');
        });
        
    });
});