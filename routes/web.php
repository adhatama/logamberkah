<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function (Request $request) {
    $request = Request::create('api/harga-kami-beli/emas-certicard', 'GET');

    $response = Route::dispatch($request);

    $hargaKamiBeliEmasCerticardList = $response->getData()->data;

    $hargaKamiBeliEmasCerticard1Gr = null;
    foreach ($hargaKamiBeliEmasCerticardList as $row) {
        if ($row->gram == 1) {
            $hargaKamiBeliEmasCerticard1Gr = $row;
        }
    }

    $request = Request::create('api/harga-kami-jual/emas-certicard', 'GET');

    $response = Route::dispatch($request);

    $hargaKamiJualEmasCerticardList = $response->getData()->data;

    $hargaKamiJualEmasCerticard1Gr = null;
    foreach ($hargaKamiJualEmasCerticardList as $row) {
        if ($row->gram == 1) {
            $hargaKamiJualEmasCerticard1Gr = $row;
        }
    }

    foreach ($hargaKamiJualEmasCerticardList as $i => $row) {
        if ($row->gram == 0.5 || $row->gram == 250 || $row->gram == 500 || $row->gram == 1000) {
            unset($hargaKamiJualEmasCerticardList[$i]);
        }
    }

    return view('home', [
        'hargaKamiBeliEmasCerticard1Gr' => $hargaKamiBeliEmasCerticard1Gr,
        'hargaKamiBeliEmasCerticardList' => $hargaKamiBeliEmasCerticardList,
        'hargaKamiJualEmasCerticard1Gr' => $hargaKamiJualEmasCerticard1Gr,
        'hargaKamiJualEmasCerticardList' => $hargaKamiJualEmasCerticardList,
    ]);
});
