<?php

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

Route::get('/', function () {
    return view('index');
});
Auth::routes();

// ROUTES KLO UDAH LOGIN
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

// ADMIN ROUTES
Route::group(['middleware' => 'RoleAdmin'], function () {
    Route::get('/admin', 'App\Http\Controllers\HomeController@admin');

    Route::get('/genre', 'App\Http\Controllers\GenreController@index');
    Route::post('/genre', 'App\Http\Controllers\GenreController@store')->name('storeGenre');
});

// MEMBER ROUTES
Route::group(['middleware' => 'RoleMember'], function () {
    Route::get('/member', 'App\Http\Controllers\HomeController@member');
});
