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

Route::get('/harga-kami-beli/{logamType}', function ($logamType, Request $request) {
    if ($logamType == 'emas-certicard') {
        $report = new PriceList(
            new HargaDasarKamiBeliEmasCertiCardSqlite,
            [
                new PercentageMarginCalculator(new HargaDasarKamiBeliEmasCertiCardSqlite),
                new NominalMarginCalculator(new HargaDasarKamiBeliEmasCertiCardSqlite)
            ]
        );
    }

    $emasPerGrams = $report->getHargaInGrams();

    return response()->json([
        'data' => $emasPerGrams
    ]);
});

Route::get('/harga-kami-jual/{logamType}', function ($logamType, Request $request) {
    if ($logamType == 'emas-certicard') {
        $report = new PriceList(
            new HargaDasarKamiJualEmasCertiCardSqlite,
            [
                new PercentageMarginCalculator(new HargaDasarKamiJualEmasCertiCardSqlite),
                new NominalMarginCalculator(new HargaDasarKamiJualEmasCertiCardSqlite)
            ]
        );
    }

    $emasPerGrams = $report->getHargaInGrams();

    return response()->json([
        'data' => $emasPerGrams
    ]);
});
