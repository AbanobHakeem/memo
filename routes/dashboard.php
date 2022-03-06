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

            Route::group(['middleware' => ['auth:admin','active','checkpermission']], function () {

                //home route
                Route::get('', "HomeController@index")->name('index');

                //logout
                Route::post('logout', 'LoginController@logout')->name('logout');

                //Admin Routes
                Route::group(['prefix' => 'admins', 'as' => 'admins.'], function () {
                    Route::get('', 'AdminController@index')->name('index');
                    Route::get('create', 'AdminController@create')->name('create');
                    Route::post('', 'AdminController@store')->name('store');
                    Route::get('{idp}/edit', 'AdminController@edit')->name('edit');
                    Route::put('{id}', 'AdminController@update')->name('update');
                    Route::delete('{id}', 'AdminController@destroy')->name('destroy');
                    Route::post('{id}/toggle', 'LangController@toggle')->name('toggle');

                });

                //User Routes
                Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
                    Route::get('', 'UserController@index')->name('index');
                    Route::get('create', 'UserController@create')->name('create');
                    Route::post('', 'UserController@store')->name('store');
                    Route::get('{idp}/edit', 'UserController@edit')->name('edit');
                    Route::put('{id}', 'UserController@update')->name('update');
                    Route::delete('{id}', 'UserController@destroy')->name('destroy');
                    Route::post('{id}/toggle', 'LangController@toggle')->name('toggle');

                });

                //Roles Routes
                Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
                    Route::get('', 'RoleController@index')->name('index');
                    Route::get('create', 'RoleController@create')->name('create');
                    Route::post('', 'RoleController@store')->name('store');
                    Route::get('{idp}/edit', 'RoleController@edit')->name('edit');
                    Route::put('{id}', 'RoleController@update')->name('update');
                    Route::delete('{id}', 'RoleController@destroy')->name('destroy');
                });

                //Permission Routes
                Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
                Route::get('', 'PermissionController@index')->name('index');
                Route::get('create', 'PermissionController@create')->name('create');
                Route::post('', 'PermissionController@store')->name('store');
                Route::get('{idp}/edit', 'PermissionController@edit')->name('edit');
                Route::put('{id}', 'PermissionController@update')->name('update');
                Route::delete('{id}', 'PermissionController@destroy')->name('destroy');
            });

                //publisher Routes
                Route::group(['prefix' => 'publishers', 'as' => 'publishers.'], function () {
                    Route::get('', 'PublisherController@index')->name('index');
                    Route::get('create', 'PublisherController@create')->name('create');
                    Route::post('', 'PublisherController@store')->name('store');
                    Route::get('{idp}/edit', 'PublisherController@edit')->name('edit');
                    Route::put('{id}', 'PublisherController@update')->name('update');
                    Route::delete('{id}', 'PublisherController@destroy')->name('destroy');
                    Route::post('{id}/toggle', 'PublisherController@toggle')->name('toggle');
                });
                
                //authour Routes
                Route::group(['prefix' => 'authours', 'as' => 'authours.'], function () {
                    Route::get('', 'AuthourController@index')->name('index');
                    Route::get('create', 'AuthourController@create')->name('create');
                    Route::post('', 'AuthourController@store')->name('store');
                    Route::get('{idp}/edit', 'AuthourController@edit')->name('edit');
                    Route::put('{id}', 'AuthourController@update')->name('update');
                    Route::delete('{id}', 'AuthourController@destroy')->name('destroy');
                    Route::post('{id}/toggle', 'AuthourController@toggle')->name('toggle');
                });

                //language Routes
                Route::group(['prefix' => 'languages', 'as' => 'languages.'], function () {
                    Route::get('', 'LangController@index')->name('index');
                    Route::get('create', 'LangController@create')->name('create');
                    Route::post('', 'LangController@store')->name('store');
                    Route::get('{idp}/edit', 'LangController@edit')->name('edit');
                    Route::put('{id}', 'LangController@update')->name('update');
                    Route::delete('{id}', 'LangController@destroy')->name('destroy');
                    Route::post('{id}/toggle', 'LangController@toggle')->name('toggle');
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
