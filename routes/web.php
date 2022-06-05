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
Route::get('/product', 'App\Http\Controllers\ProductController@index');

// ROUTES KLO UDAH LOGIN
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

// ADMIN ROUTES
Route::group(['middleware' => 'RoleAdmin'], function () {
    Route::get('/admin', 'App\Http\Controllers\HomeController@admin');

    // 1. Genre
    Route::get('/category', 'App\Http\Controllers\CategoryController@index');
    Route::post('/category', 'App\Http\Controllers\CategoryController@store')->name('storeCategory');
    Route::get('/category/{id}', 'App\Http\Controllers\CategoryController@edit')->name('editCategory');
    Route::put('/category/{id}', 'App\Http\Controllers\CategoryController@update')->name('updateCategory');
    Route::delete('/category/{id}', 'App\Http\Controllers\CategoryController@delete')->name('deletecategory');

    // 2. Accept Movie
    Route::put('/product/accept/{id}', 'App\Http\Controllers\ProductController@acceptProduct')->name('acceptProduct');
});

// MEMBER ROUTES
Route::group(['middleware' => 'RoleMember'], function () {
    Route::get('/member', 'App\Http\Controllers\HomeController@member');

    // 2. Movie
    Route::post('/product', 'App\Http\Controllers\ProductController@store')->name('storeProduct');
    Route::get('/product/{id}', 'App\Http\Controllers\ProductController@edit')->name('editProduct');
    Route::put('/product/{id}', 'App\Http\Controllers\ProductController@update')->name('updateProduct');
    Route::delete('/product/{id}', 'App\Http\Controllers\ProductController@delete')->name('deleteProduct');
});
