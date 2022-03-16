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

Route::get('/','UserController@index')->name('front.login');;
Route::POST('/check','UserController@check')->name('login.check');
Route::POST('/login','UserController@logout')->name('user.logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/employee', 'EmployeeController@index')->name('employee');
Route::POST('/store', 'EmployeeController@store')->name('employee.store');
Route::PUT('/update', 'EmployeeController@update')->name('employee.update');
Route::get('/edit', 'EmployeeController@edit')->name('employee.edit');

Route::get('/category', 'CategoryController@index')->name('category');
Route::POST('/cstore', 'CategoryController@store')->name('category.store');
Route::PUT('/cupdate', 'CategoryController@update')->name('category.update');
Route::get('/cedit', 'CategoryeController@edit')->name('category.edit');


Route::get('/item', 'ItemController@index')->name('item');
Route::POST('/istore', 'ItemController@store')->name('item.store');
Route::PUT('/iupdate', 'ItemController@update')->name('item.update');
Route::get('/iedit', 'ItemController@edit')->name('item.edit');