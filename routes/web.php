<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

//localtion prefix and middle ware
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::group(['prefix' => '/', 'as' => 'frontend', 'namespace' => 'Frontend'], function () {
            Route::get('', "HomeController@index")->name('.home');
            Route::get('langs', "HomeController@langs")->name('.langs');
        });


        //laravel auth routes
        Auth::routes();
    }
);
