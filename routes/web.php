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

    // lang routes
    Route::get('lang/{lang}', 'SiteController@lang')->name('lang');

    Route::group(['middleware'=>'lang'],function (){

        Route::get('/', 'SiteController@index')->name('home');
        Route::get('product/{id}', 'SiteController@product')->name('product');

        Route::get('view/{id}', 'SiteController@view')->name('view');
        Route::post('addorder/{id}', 'SiteController@addorder')->name('add.order');
        // for ajax
        Route::get('addOrderByajax', 'SiteController@addOrderByajax')->name('add.order.ajax');

        Route::get('delivery', 'SiteController@delivery')->name('delivery');
        Route::post('setlocation', 'SiteController@setlocation')->name('set.location');

        Route::get('cart', 'SiteController@cart')->name('cart');
        //ajax in cart
        Route::get('removeItemOrder', 'SiteController@removeItemOrder')->name('remove.itemOrder');
        Route::get('numItemOrder', 'SiteController@numItemOrder')->name('num.itemOrder');
        Route::get('promocode', 'SiteController@checkPromoCode')->name('promo.code');
        Route::get('removepromocode', 'SiteController@removePromoCode')->name('remove.promo.code');

        Route::get('adress', 'SiteController@adress')->name('adress');
        Route::post('setadress', 'SiteController@setadress')->name('set.adress');
        Route::get('otpview', 'SiteController@otpview')->name('otpview');
        Route::post('otpCheck', 'SiteController@otpCheck')->name('otpCheck');
        Route::get('credit', 'SiteController@credit')->name('credit');
        Route::get('cash', 'SiteController@cash')->name('cash');
        Route::get('thankspage', 'SiteController@thankspage')->name('thankspage');

        Route::get('checkorder', 'SiteController@checkorder')->name('check.order');
        Route::post('checkorder', 'SiteController@checkorderp')->name('check.order.p');

        //ajax credit
        Route::get('get-checkout-id', 'PaymentProviderController@getCheckOutId')->name('offers.checkout');

        Route::get('search', 'SiteController@search')->name('search');
        Route::get('branches', 'SiteController@branches')->name('branches');


    });


});

//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
