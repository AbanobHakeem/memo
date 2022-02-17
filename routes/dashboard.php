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

Route::group(['middleware' => 'guest:admin'], function () {

    //login Routes
    Route::get('login', "LoginController@loginPage")->name('.loginpage');
    Route::post('login', "LoginController@login")->name('.login');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('', "HomeController@index")->name('.index');
});
