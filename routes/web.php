<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Kasir\KasirController;
use App\Http\Controllers\Kasir\PeminjamanController;
use App\Http\Controllers\Kasir\PengembalianController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Role Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function() {

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
        
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Anggota
        Route::controller(AnggotaController::class)
        ->prefix('anggota')
        ->name('anggota.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/edit/{anggota:uuid}', 'edit')->name('edit');
            Route::put('/{anggota:uuid}', 'update')->name('update');
            Route::delete('/{anggota:uuid}', 'destroy')->name('destroy');
        });

        // Buku
        Route::controller(BukuController::class)
        ->prefix('buku')
        ->name('buku.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/edit/{buku:uuid}', 'edit')->name('edit');
            Route::put('/{buku:uuid}', 'update')->name('update');
            Route::delete('/{buku:uuid}', 'destroy')->name('destroy');
        });

    });

    /*
    |--------------------------------------------------------------------------
    | Kasir Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:kasir'])
        ->prefix('kasir')
        ->name('kasir.')
        ->group(function () {
        
        // Dashboard
        Route::get('/dashboard', [KasirController::class, 'index'])->name('dashboard');

        // Peminjaman
        Route::controller(PeminjamanController::class)
        ->prefix('peminjaman')
        ->name('peminjaman.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/edit/{peminjaman:uuid}', 'edit')->name('edit');
            Route::put('/{peminjaman:uuid}', 'update')->name('update');
            Route::delete('/{peminjaman:uuid}', 'destroy')->name('destroy');
        });

        // Pengembalian
        Route::controller(PengembalianController::class)
        ->prefix('pengembalian')
        ->name('pengembalian.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/edit/{pengembalian:uuid}', 'edit')->name('edit');
            Route::put('/{pengembalian:uuid}', 'update')->name('update');
            Route::delete('/{pengembalian:uuid}', 'destroy')->name('destroy');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */
        Route::middleware(['role:user'])
        ->prefix('user')
        ->name('user.')
        ->group(function () {
        
        // Dashboard
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    });

});


// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
