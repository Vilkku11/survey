<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function() {
    /*Route::get('/dashboard', function () {
        return Inertia::render('Dashboard',);
    })->name('dashboard');*/
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('surveys', SurveyController::class);


   // Route::prefix('surveys/{survey}')->group(function() {
   //     Route::resource('questions', QuestionController::class);
   // });

});

#Route::get('/dashboard', function () {
#    return Inertia::render('Dashboard',);
#})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
