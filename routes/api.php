<?php

use App\Domains\HargaDasarKamiBeliEmasCertiCardSqlite;
use App\Domains\HargaDasarKamiJualEmasCertiCardSqlite;
use App\Domains\NominalMarginCalculator;
use App\Domains\PercentageMarginCalculator;
use App\Domains\PriceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/harga-kami-beli/emas', function (Request $request) {
    $priceList = new PriceList();

    $hargaInGrams = $priceList->getHargaKamiBeliInGrams();

    return response()->json([
        'data' => $hargaInGrams
    ]);
});

Route::get('/harga-kami-jual/emas', function (Request $request) {
    $priceList = new PriceList();

    $hargaInGrams = $priceList->getHargaKamiJualInGrams();

    return response()->json([
        'data' => $hargaInGrams
    ]);
});
