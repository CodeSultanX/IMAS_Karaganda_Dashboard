<?php

use App\Http\Controllers\Frontend\Admin\DashAdminController;
use App\Http\Controllers\Frontend\Main\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/',[DashboardController::class,'index'])->name('main');

Route::middleware('auth')->group(function () {
    Route::get('/dash-admin',[DashAdminController::class,'index'])->name('dash-admin.index');
    Route::get('/dash-admin/projects',[DashAdminController::class,'projects'])->name('dash-admin.projects');
});



require __DIR__.'/auth.php';
