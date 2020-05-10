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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('delete/{id?}', 'HomeController@delete')->name('delete');
Route::post('create', 'HomeController@insert')->name('create');
Route::post('update', 'HomeController@update')->name('update');
Route::post('updatestatus', 'HomeController@updatestatus')->name('updatestatus');

Route::get('/settings', 'SettingsController@index')->name('settings');
Route::post('create-Category', 'SettingsController@insert')->name('createcategory');
Route::get('delete-Category/{id?}', 'SettingsController@delete')->name('deletecategory');