<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdvertentieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BiddingController;
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

Route::get('/welcome', function () {
    return view('Welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/account/roles', [AccountController::class, 'index'])->middleware('auth')->name('account.roles');
Route::get('/account/roles/edit', [AccountController::class, 'editRoles'])->middleware('auth')->name('account.editroles');
Route::post('/account/roles', [AccountController::class, 'updateRoles'])->middleware('auth')->name('account.updateroles');
Route::get('/account/login', [AccountController::class, 'login'])->name('account.login');
Route::post('/account/login', [AccountController::class, 'authenticate'])->name('account.authenticate');
Route::get('/account/register', [AccountController::class, 'register'])->name('account.register');
Route::post('/account/register', [AccountController::class, 'store'])->name('account.store');
Route::post('/account/logout', [AccountController::class, 'logout'])->name('account.logout');

Route::get('advertenties', [AdvertentieController::class, 'index'])->middleware('auth')->name('advertentie.index');
Route::get('advertenties/create', [AdvertentieController::class, 'create'])->middleware('auth')->name('advertentie.create');
Route::post('advertenties', [AdvertentieController::class, 'store'])->middleware('auth')->name('advertentie.store');
Route::get('advertenties/{id}/edit', [AdvertentieController::class, 'edit'])->middleware('auth')->name('advertentie.edit');
Route::delete('advertenties/{id}/delete', [AdvertentieController::class, 'destroy'])->middleware('auth')->name('advertentie.destroy');
Route::put('advertenties/{id}', [AdvertentieController::class, 'update'])->middleware('auth')->name('advertentie.update');
Route::get('advertenties/{id}', [AdvertentieController::class, 'show'])->middleware('auth')->name('advertentie.show');

Route::get('bidding', [BiddingController::class, 'index'])->middleware('auth')->name('bidding.index');
Route::get('bidding/create/{ad}', [BiddingController::class, 'create'])->middleware('auth')->name('bidding.create');
Route::post('bidding', [BiddingController::class, 'store'])->middleware('auth')->name('bidding.store');
Route::get('bidding/{bidding}', [BiddingController::class, 'show'])->middleware('auth')->name('bidding.show');
Route::get('bidding/{bidding}/edit', [BiddingController::class, 'edit'])->middleware('auth')->name('bidding.edit');
Route::put('bidding/{bidding}', [BiddingController::class, 'update'])->middleware('auth')->name('bidding.update');
Route::delete('bidding/{bidding}', [BiddingController::class, 'destroy'])->middleware('auth')->name('bidding.destroy');

require __DIR__.'/auth.php';
