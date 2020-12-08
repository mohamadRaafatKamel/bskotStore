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
    Route::post('addorder/{id}', 'SiteController@addorder')->name('add.order');

    Route::get('delivery', 'SiteController@delivery')->name('delivery');
    Route::post('setlocation', 'SiteController@setlocation')->name('set.location');

    Route::get('cart', 'SiteController@cart')->name('cart');
    Route::get('adress', 'SiteController@adress')->name('adress');
    Route::post('setadress', 'SiteController@setadress')->name('set.adress');

    Route::get('search', 'SiteController@search')->name('search');
});

//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
