<?php

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {


        Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {

            Route::group(['middleware' => 'guest:admin'], function () {
                //login Routes
                Route::get('login', "LoginController@loginPage")->name('loginpage');
                Route::post('login', "LoginController@login")->name('login');
            });

            Route::group(['middleware' => 'auth:admin'], function () {

                //home route
                Route::get('', "HomeController@index")->name('index');

                //logout
                Route::post('logout', 'LoginController@logout')->name('logout');

                //language Routes
                Route::group(['prefix' => 'languages', 'as' => 'languages.'], function () {
                    Route::get('', 'LangController@index')->name('index');
                    Route::get('create', 'LangController@create')->name('create');
                    Route::post('', 'LangController@store')->name('store');
                    Route::get('{idp}/edit', 'LangController@edit')->name('edit');
                    Route::put('{id}', 'LangController@update')->name('update');
                    Route::delete('{id}', 'LangController@destroy')->name('destroy');
                    Route::post('{lang}/toggle', 'LangController@toggle')->name('toggle');
                });

                //publisher Routes
                Route::group(['prefix' => 'publishers', 'as' => 'publishers.'], function () {
                    Route::get('', 'PublisherController@index')->name('index');
                    Route::get('create', 'PublisherController@create')->name('create');
                    Route::post('', 'PublisherController@store')->name('store');
                    Route::get('{idp}/edit', 'PublisherController@edit')->name('edit');
                    Route::put('{id}', 'PublisherController@update')->name('update');
                    Route::delete('{id}', 'PublisherController@destroy')->name('destroy');
                    Route::post('{lang}/toggle', 'PublisherController@toggle')->name('toggle');
                });

                //Translation Routes
                Route::group(['prefix' => 'translation', 'as' => 'translation.'], function () {
                    Route::get('', 'TranslationController@index')->name('index');
                    Route::post('', 'TranslationController@store')->name('store');
                    Route::delete('destroy', 'TranslationController@destroy')->name('destroy');
                });
            });
        });
    }
);
