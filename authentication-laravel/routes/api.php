<?php

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

// Register/Login
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

// CRUD Barang
Route::post('/insertBarang', 'barangController@insertBarang')->middleware('jwt.verify');
Route::put('/updateBarang/{id}', 'barangController@updateBarang')->middleware('jwt.verify');
Route::delete('/deleteBarang/{id}', 'barangController@deleteBarang')->middleware('jwt.verify');
// CRUD Pembeli
Route::post('/insertPembeli', 'pembeliController@insertPembeli')->middleware('jwt.verify');
Route::put('/updatePembeli/{id}', 'pembeliController@updatePembeli')->middleware('jwt.verify');
Route::delete('/deletePembeli/{id}', 'pembeliController@deletePembeli')->middleware('jwt.verify');
// CRUD Transaksi
Route::post('/insertTransaksi', 'transaksiController@insertTransaksi')->middleware('jwt.verify');
Route::put('/updateTransaksi/{id}', 'transaksiController@updateTransaksi')->middleware('jwt.verify');
Route::delete('/deleteTransaksi/{id}', 'transaksiController@deleteTransaksi')->middleware('jwt.verify');

