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

Route::group(['namespace'=>'App\Http\Controllers', 'middleware'=>'guest'],function (){

    Route::get('/', 'SiteController@index')->name('home');
    Route::get('product/{id}', 'SiteController@product')->name('product');
    Route::get('view/{id}', 'SiteController@view')->name('view');
    //Route::post('login', 'LoginController@login')->name('admin.login');
});

//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
