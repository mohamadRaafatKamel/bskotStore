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

    ##################### Emarh ############################
    Route::group(['prefix'=>'Emarh'],function (){
        Route::get('/','EmarhController@index')->name('admin.emarh');
        Route::get('create','EmarhController@create')->name('admin.emarh.create');
        Route::post('store','EmarhController@store')->name('admin.emarh.store');

        Route::get('edit/{id}','EmarhController@edit')->name('admin.emarh.edit');
        Route::post('update/{id}','EmarhController@update')->name('admin.emarh.update');

        Route::get('delete/{id}','EmarhController@destroy') -> name('admin.emarh.delete');
    });
    ##################### End Emarh ########################

    ##################### Area ############################
    Route::group(['prefix'=>'Area'],function (){
        Route::get('/','AreaController@index')->name('admin.area');
        Route::get('create','AreaController@create')->name('admin.area.create');
        Route::post('store','AreaController@store')->name('admin.area.store');

        Route::get('edit/{id}','AreaController@edit')->name('admin.area.edit');
        Route::post('update/{id}','AreaController@update')->name('admin.area.update');

        Route::get('delete/{id}','AreaController@destroy') -> name('admin.area.delete');
    });
    ##################### End Area ########################

    ##################### Order ############################
    Route::group(['prefix'=>'Order'],function (){
        Route::get('/','OrderController@index')->name('admin.order');
        Route::get('/sending','OrderController@sending')->name('admin.order.sending');
        Route::get('/done','OrderController@done')->name('admin.order.done');

        Route::get('view/{id}','OrderController@view')->name('admin.order.view');
        Route::get('vsending/{id}','OrderController@viewSending')->name('admin.order.view.sending');
        Route::get('vdone/{id}','OrderController@viewDone') -> name('admin.order.view.done');
    });
    ##################### End Order ########################

});


Route::group(['namespace'=>'App\Http\Controllers\Admin', 'middleware'=>'guest:admin'],function (){

    Route::get('login', 'LoginController@getLogin')->name('admin.getlogin');
    Route::post('login', 'LoginController@login')->name('admin.login');
});

//Auth::routes();

