<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('login.')
    ->prefix('login')
    ->group(function () {
        Route::get('/', 'Auth\LoginController@showLogin')->name('view');
        Route::post('/', 'Auth\LoginController@authenticate')->name('execute');
    });

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group([
    'middleware' => ['auth.admin']
], function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('user', 'UserController@index')->name('user.index');
});
