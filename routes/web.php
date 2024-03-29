<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdvertentieController;
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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/account/roles', [AccountController::class, 'index'])
    ->middleware('auth')
    ->name('account.roles');

Route::get('/account/roles/edit', [AccountController::class, 'editRoles'])
    ->middleware('auth')
    ->name('account.editroles');
    
Route::post('/account/roles', [AccountController::class, 'updateRoles'])
    ->middleware('auth')
    ->name('account.updateroles');

Route::get('advertenties', [AdvertentieController::class, 'index'])
    ->middleware('auth')
    ->name('advertentie.index');

Route::get('advertenties/create', [AdvertentieController::class, 'create'])
    ->middleware('auth')
    ->name('advertentie.create');

Route::post('advertenties', [AdvertentieController::class, 'store'])
    ->middleware('auth')
    ->name('advertentie.store');

require __DIR__.'/auth.php';
