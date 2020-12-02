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

        //Route::get('delete/{id}','CategoryController@destroy') -> name('admin.category.delete');
    });
    ##################### End Category ########################

});


Route::group(['namespace'=>'App\Http\Controllers\Admin', 'middleware'=>'guest:admin'],function (){

    Route::get('login', 'LoginController@getLogin')->name('admin.getlogin');
    Route::post('login', 'LoginController@login')->name('admin.login');
});

//Auth::routes();

