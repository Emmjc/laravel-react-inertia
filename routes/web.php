<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/','/dashboard');


//this route is to check if the user is authorized to login and also when the user acccess /dashboard when not authorized it will be redirected to login and if the user access / when logged in it will be redirected to /dashboard only.
Route::middleware(['auth','verified'])->group(function(){
    Route::get('/dashboard', fn() => Inertia::render('Dashboard'))
    ->name('dashboard');
    //routes for project, task, and user
    Route::resource('project', ProjectController::class);
    Route::resource('task', TaskController::class);
    Route::resource('user', UserController::class);
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
