<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PengumpulanController;
use App\Http\Controllers\VideoProgressController;

// halaman utama
Route::get('/', function () {
    return view('index');
})->name('index');

// halaman tentang kita
Route::get('/tentang-kita', function(){
    return view('kita');
})->name('kita');

// halaman tugas
Route::get('/tugas', function(){
    return view('tugas');
})->name('tugas')->middleware('auth','verified','role:user|admin');

// halaman monitoring 
Route::middleware('auth')->group(function() {
    Route::get('/monitoring', [MonitoringController::class,'monitoring'])->name('monitoring')->middleware('auth','verified','role:pembimbing|admin');
});

// halaman materi
Route::middleware('auth')->group(function(){
    Route::get('/materi', [MateriController::class, 'index'])->name('materi')->middleware('auth','verified','role:user|admin');
    Route::get('/materi/{slug}',[MateriController::class,'show'])->name('materi.show')->middleware('auth','verified','role:user|admin');
});

// controller video progress
Route::middleware('auth')->group(function(){
    Route::post('/video-progress', [VideoProgressController::class, 'store']);
    Route::get('/video-progress/all', [VideoProgressController::class, 'getAll'])->middleware('auth');
    Route::middleware('auth:sanctum')->post('/video-progress/complete', [VideoProgressController::class, 'complete']);
    Route::post('/api/video-progress/complete', [VideoProgressController::class, 'markComplete']);
    Route::get('/video-progress/{video}', [VideoProgressController::class, 'get']);
});

// controller pengumpulan tugas
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/tugas', [TugasController::class, 'index'])->name('tugas.index');

    Route::middleware(['role:admin|pembimbing'])->group(function () {
        Route::get('/tugas/create', [TugasController::class, 'create'])->name('tugas.create');  
        Route::post('/tugas', [TugasController::class, 'store'])->name('tugas.store'); 
    });

    Route::get('/tugas/{id}', [TugasController::class, 'show'])->name('tugas.show');
    Route::post('/tugas/{id}/submit', [TugasController::class, 'submit'])->name('tugas.submit');

    Route::middleware(['role:admin|pembimbing'])->group(function () {
        Route::get('/tugas/{id}/pengumpulan', [TugasController::class, 'pengumpulan'])->name('tugas.pengumpulan');
        Route::post('/tugas/{id}/nilai/{userId}', [TugasController::class, 'nilai'])->name('tugas.nilai');
        Route::post('/tugas/{tugas}/kumpul', [PengumpulanController::class, 'store'])->name('pengumpulan.store');
        Route::delete('/tugas/{id}', [TugasController::class, 'destroy'])->name('tugas.destroy');
        Route::delete('/tugas/judul/{judul}', [TugasController::class, 'destroyByJudul'])->name('tugas.destroyByJudul');
        Route::put('/submissions/{id}', [TugasController::class, 'update'])->name('submissions.update');
    });
});

// menu profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
