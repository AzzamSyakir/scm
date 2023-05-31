<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Karyawan\HomeController as KaryawanHome;
use App\Http\Controllers\barang\HomeController as BarangHome;
use App\Http\Controllers\Gudang\HomeController as GudangHome;

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
    
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// karyawan
Route::prefix('karyawan')->group(function () {
    Route::post('TambahKaryawan', [GudangHome::class, 'RegisterUser']);
    Route::post('Login', [KaryawanHome::class, 'LoginUser']);
});
// gudang
Route::prefix('gudang')->group(function () {
    Route::post('daftar gudang', [GudangHome::class, 'DaftarGudang']);
    Route::post('Login', [KaryawanHome::class, 'LoginUser']);
});
// barang
Route::prefix('Barang')->group(function () {
    Route::post('TambahBarang', [BarangHome::class, 'AddItem'])->middleware(['auth:api']);
    Route::post('PersiapanBarang', [BarangHome::class, 'persiapanBarang'])->middleware(['auth:api']);
});
