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

Route::get('/', 'App\Http\Controllers\PageController@index');
Auth::routes();

// PAGES
Route::get('/movie', 'App\Http\Controllers\MovieController@index');

// ROUTES KLO UDAH LOGIN
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

// ADMIN ROUTES
Route::group(['middleware' => 'RoleAdmin'], function () {
    Route::get('/admin', 'App\Http\Controllers\HomeController@admin');

    // 1. Genre
    Route::get('/genre', 'App\Http\Controllers\GenreController@index');
    Route::post('/genre', 'App\Http\Controllers\GenreController@store')->name('storeGenre');
    Route::get('/genre/{id}', 'App\Http\Controllers\GenreController@edit')->name('editGenre');
    Route::put('/genre/{id}', 'App\Http\Controllers\GenreController@update')->name('updateGenre');
    Route::delete('/genre/{id}', 'App\Http\Controllers\GenreController@delete')->name('deleteGenre');
});

// MEMBER ROUTES
Route::group(['middleware' => 'RoleMember'], function () {
    Route::get('/member', 'App\Http\Controllers\HomeController@member');

    // 2. Movie
    Route::post('/movie', 'App\Http\Controllers\MovieController@store')->name('storeMovie');
    Route::get('/movie/{id}', 'App\Http\Controllers\MovieController@edit')->name('editMovie');
    Route::put('/movie/{id}', 'App\Http\Controllers\MovieController@update')->name('updateMovie');
    Route::delete('/movie/{id}', 'App\Http\Controllers\MovieController@delete')->name('deleteMovie');
});
