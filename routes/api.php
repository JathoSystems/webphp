<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\AdvertentieResource;
use App\Models\Advertentie;
use App\Http\Resources\BedrijfResource;
use App\Models\Bedrijf;
use App\Http\Resources\BiddingResource;
use App\Models\Bidding;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/advertentie/{id}', function (string $id) {
    return new AdvertentieResource(Advertentie::findOrFail($id));
});

Route::get('/advertenties', function () {
    return AdvertentieResource::collection(Advertentie::all());
});

Route::get('/bedrijf/{id}', function (string $id) {
    return new BedrijfResource(Bedrijf::findOrFail($id));
});

Route::get('/bedrijven', function () {
    return BedrijfResource::collection(Bedrijf::all());
});

Route::get('/bidding/{id}', function (string $id) {
    return new BiddingResource(Bidding::findOrFail($id));
});

Route::get('/biddings', function () {
    return BiddingResource::collection(Bidding::all());
});