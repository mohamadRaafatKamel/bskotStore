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
define('PAGINATION_COUNT',10);

Route::group(['namespace'=>'App\Http\Controllers\Admin', 'middleware'=>'auth:admin'],function (){

    Route::get('/','DashboardController@index')->name('admin.dashboard');
    Route::get('logout','DashboardController@logout')->name('admin.logout');
    ##################### Category ############################
    Route::group(['prefix'=>'category'],function (){
        Route::get('/','CategoryController@index')->name('admin.category');
        Route::get('create','CategoryController@create')->name('admin.category.create');
        Route::post('store','CategoryController@store')->name('admin.category.store');

        Route::get('edit/{id}','CategoryController@edit')->name('admin.category.edit');
        Route::post('update/{id}','CategoryController@update')->name('admin.category.update');

        Route::get('delete/{id}','CategoryController@destroy') -> name('admin.category.delete');
    });
    ##################### End Category ########################

    ##################### Promo Code ############################
    Route::group(['prefix'=>'promocode'],function (){
        Route::get('/','PoromocodeController@index')->name('admin.promocode');
        Route::get('create','PoromocodeController@create')->name('admin.promocode.create');
        Route::post('store','PoromocodeController@store')->name('admin.promocode.store');

        Route::get('edit/{id}','PoromocodeController@edit')->name('admin.promocode.edit');
        Route::post('update/{id}','PoromocodeController@update')->name('admin.promocode.update');

        Route::get('delete/{id}','PoromocodeController@destroy') -> name('admin.promocode.delete');
    });
    ##################### End Promo Code ########################

    ##################### Product ############################
    Route::group(['prefix'=>'product'],function (){
        Route::get('/','ProductController@index')->name('admin.product');
        Route::get('create','ProductController@create')->name('admin.product.create');
        Route::post('store','ProductController@store')->name('admin.product.store');

        Route::get('edit/{id}','ProductController@edit')->name('admin.product.edit');
        Route::post('update/{id}','ProductController@update')->name('admin.product.update');

        Route::get('delete/{id}','ProductController@destroy') -> name('admin.product.delete');
    });
    ##################### End Product ########################

});


Route::group(['namespace'=>'App\Http\Controllers\Admin', 'middleware'=>'guest:admin'],function (){

    Route::get('login', 'LoginController@getLogin')->name('admin.getlogin');
    Route::post('login', 'LoginController@login')->name('admin.login');
});

//Auth::routes();

