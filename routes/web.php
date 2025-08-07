<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\HomeController;

Route::redirect('/', '/home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();
Route::middleware(['auth'])->group(function() {
    Route::resource('proyeks', ProyekController::class)->parameters([
        'proyeks' => 'proyek'
    ]);
    Route::resource('tugas', TugasController::class)->parameters([
        'tugas' => 'tugas'
    ]);
    
    // Export routes
    Route::get('proyeks/export/{format}', [ProyekController::class, 'export'])->name('proyeks.export');
});
