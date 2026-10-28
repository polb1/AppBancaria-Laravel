<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\TipusCompteController;
use App\Http\Controllers\Admin\CompteController;
use App\Http\Controllers\Admin\BizumController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\CompteClientController;
use App\Http\Controllers\Client\BizumClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Pàgina principal
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

// Pàgina sense permisos
Route::get('/noAdmin', function () {
    return view('noAdmin');
})->name('noAdmin');

// Rutes Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('clients', ClientController::class);
    Route::resource('tipus-comptes', TipusCompteController::class);
    Route::resource('comptes', CompteController::class);
    Route::get('bizums', [BizumController::class, 'index'])->name('bizums.index');
});

// Rutes Client
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        if (Auth::user()->email === 'admin@admin.cat') {
            return redirect()->route('admin.dashboard');
        }
        return app(DashboardController::class)->index();
    })->name('dashboard');

    Route::get('/comptes/crear', [CompteClientController::class, 'create'])->name('comptes.create');
    Route::post('/comptes', [CompteClientController::class, 'store'])->name('comptes.store');
    Route::get('/comptes/{id}', [CompteClientController::class, 'show'])->name('comptes.show');
    Route::get('/bizum', [BizumClientController::class, 'index'])->name('bizum.index');
    Route::post('/bizum', [BizumClientController::class, 'store'])->name('bizum.store');
});

// Rutes Perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';