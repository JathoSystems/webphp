<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdvertentieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BiddingController;
use App\Http\Controllers\BedrijfController;
use App\Http\Controllers\RentingController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ComponentController;
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
Route::get('/setlocale/{locale}', [HomeController::class, 'setLocale'])->name('locale');

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
Route::get('advertenties/favorieten', [AdvertentieController::class, 'favorieten'])->middleware('auth')->name('advertentie.favorieten');
Route::get('advertenties/create', [AdvertentieController::class, 'create'])->middleware('auth')->name('advertentie.create');
Route::post('advertenties', [AdvertentieController::class, 'store'])->middleware('auth')->name('advertentie.store');
Route::get('advertenties/{id}/edit', [AdvertentieController::class, 'edit'])->middleware('auth')->name('advertentie.edit');
Route::delete('advertenties/{id}/delete', [AdvertentieController::class, 'destroy'])->middleware('auth')->name('advertentie.destroy');
Route::put('advertenties/{id}', [AdvertentieController::class, 'update'])->middleware('auth')->name('advertentie.update');
Route::put('advertenties/{advertentie}/favorite', [AdvertentieController::class, 'markFavorite'])->middleware('auth')->name('advertentie.favorite');
Route::get('advertenties/{id}', [AdvertentieController::class, 'show'])->middleware('auth')->name('advertentie.show');
Route::get('advertenties/{id}/review', [AdvertentieController::class, 'review'])->middleware('auth')->name('advertentie.review');
Route::post('advertenties/{id}/review', [AdvertentieController::class, 'addReview'])->middleware('auth')->name('advertentie.addReview');

Route::get('importeren', [AdvertentieController::class, 'importeren'])->middleware('auth')->name('advertentie.importeren');
Route::post('importAdvertenties', [AdvertentieController::class, 'importAdvertenties'])->middleware('auth')->name('advertentie.importAdvertenties');

Route::get('bidding', [BiddingController::class, 'index'])->middleware('auth')->name('bidding.index');
Route::get('bidding/create/{ad}', [BiddingController::class, 'create'])->middleware('auth')->name('bidding.create');
Route::post('bidding', [BiddingController::class, 'store'])->middleware('auth')->name('bidding.store');
Route::get('bidding/{bidding}', [BiddingController::class, 'show'])->middleware('auth')->name('bidding.show');
Route::get('bidding/{bidding}/edit', [BiddingController::class, 'edit'])->middleware('auth')->name('bidding.edit');
Route::put('bidding/{bidding}', [BiddingController::class, 'update'])->middleware('auth')->name('bidding.update');
Route::delete('bidding/{bidding}', [BiddingController::class, 'destroy'])->middleware('auth')->name('bidding.destroy');

Route::get('renting', [RentingController::class, 'index'])->middleware('auth')->name('renting.index');
Route::get('renting/create/{ad}', [RentingController::class, 'create'])->middleware('auth')->name('renting.create');
Route::post('renting', [RentingController::class, 'store'])->middleware('auth')->name('renting.store');

Route::get('company/create', [BedrijfController::class, 'create'])->middleware('auth')->name('company.create');
Route::post('company', [BedrijfController::class, 'store'])->middleware('auth')->name('company.store');
Route::get('company/{company}/edit', [BedrijfController::class, 'edit'])->middleware('auth')->name('company.edit');
Route::post('company/{company}', [BedrijfController::class, 'update'])->middleware('auth')->name('company.update');
Route::get('company/{url}', [BedrijfController::class, 'showCustomUrl'])->middleware('auth')->name('company.show');
Route::get('company', [BedrijfController::class, 'index'])->middleware('auth')->name('company.index');

Route::get('components/{company_id}', [ComponentController::class, 'index'])->middleware('auth')->name('component.index');
Route::get('components/create/{company_id}', [ComponentController::class, 'create'])->middleware('auth')->name('component.create');
Route::post('components', [ComponentController::class, 'store'])->middleware('auth')->name('component.store');
Route::get('components/{component}/edit', [ComponentController::class, 'edit'])->middleware('auth')->name('component.edit');
Route::put('components/{component}', [ComponentController::class, 'update'])->middleware('auth')->name('component.update');
Route::delete('components/{component}', [ComponentController::class, 'destroy'])->middleware('auth')->name('component.destroy');

Route::get('contracts', [ContractController::class, 'index'])->middleware('auth')->name('contract.index');
Route::get('contracts/create', [ContractController::class, 'create'])->middleware('auth')->name('contracts.create');
Route::post('contracts', [ContractController::class, 'store'])->middleware('auth')->name('contracts.store');


require __DIR__.'/auth.php';
