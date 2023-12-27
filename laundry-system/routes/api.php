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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// USER
Route::post('login', 'AuthController@login');


Route::group(['middleware' => ['jwt.verify:admin,kasir,owner']], function () {
    Route::get('login/check', 'AuthController@loginCheck');
    Route::post('/logout', 'AuthController@logout');
    Route::get('/dashboard', 'DashboardController@index');
    Route::post('/report', 'TransaksiController@report');
});

Route::group(['middleware' => ['jwt.verify:admin']], function() {
    
    // OUTLET
    Route::get('/outlet', 'OutletController@getAll');
    Route::get('/outlet/{id}', 'OutletController@getById');
    Route::post('/outlet', 'OutletController@store');
    Route::put('/outlet/{id}', 'OutletController@update');
    Route::delete('/outlet/{id}', 'OutletController@delete');

    // PAKET
    Route::get('/paket', 'PaketController@show');
    Route::get('/paket/{id}', 'PaketController@getById');
    Route::post('/paket', 'PaketController@store');
    Route::delete('/paket/{id}', 'PaketController@delete');
    Route::put('/paket/{id}', 'PaketController@update');

    // USER
    Route::post('user/tambah', 'UserController@store');
    Route::get('/user', 'UserController@getAll');
    Route::get('/user/{id}', 'UserController@getById');
    Route::put('/user/{id}', 'UserController@update');
    Route::delete('/user/{id}', 'UserController@delete');
});

Route::group(['middleware' => ['jwt.verify:admin,kasir']], function() {
    // MEMBER
    Route::get('/member/show', 'MemberController@showAll');
    Route::get('/member/show/{id}', 'MemberController@getById');
    Route::post('/member', 'MemberController@store');
    Route::put('/member/{id}', 'MemberController@update');
    Route::delete('/member/{id}', 'MemberController@delete');
    
    // TRANSAKSI
    Route::post('/transaksi', 'TransaksiController@store');
    Route::post('/transaksi/status/{id}', 'TransaksiController@changeStatus');
    Route::post('/transaksi/bayar/{id}', 'TransaksiController@bayar');
    Route::get('/transaksi/tampil', 'TransaksiController@showAll');
    Route::get('/transaksi/tampil/{id}', 'TransaksiController@showById');
    Route::put('/transaksi/{id}', 'TransaksiController@update');

    // DETAIL TRANSAKSI
    Route::post('transaksi/detail', 'DetailTransaksiController@store');
    Route::get('transaksi/detail', 'DetailTransaksiController@showAllDetail');
    Route::get('transaksi/detail/{id}', 'DetailTransaksiController@showDetailById');
    Route::get('transaksi/total/{id}', 'DetailTransaksiController@getTotal');
});