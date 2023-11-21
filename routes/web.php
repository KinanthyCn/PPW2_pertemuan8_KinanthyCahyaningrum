<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect('/buku');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/buku', [BukuController::class, 'index'])->name('buku');

    Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');

    Route::middleware('admin')->group(function () {
        Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/buku/store', [BukuController::class, 'store'])->name('buku.store');

        Route::post('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

        //update
        Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        //store update
        Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
        Route::get('/buku/delete-gallery/{id}', [BukuController::class, 'deleteGallery'])->name('buku.delete-gallery');
    });
    

});
    Route::get('/list_buku', [BukuController::class, 'showList'])->name('buku.list_buku');
    Route::get('/detail_buku/{id}', [BukuController::class, 'galbuku'])->name('buku.galeri.buku');

require __DIR__.'/auth.php';


