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
//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/employee', 'EmployeeController@index')->name('employee');
Route::POST('/store', 'EmployeeController@store')->name('employee.store');
Route::PUT('/update/{id}', 'EmployeeController@update')->name('employee.update');
Route::get('/edit/{id}', 'EmployeeController@edit')->name('employee.edit');
Route::POST('/changestatus', 'EmployeeController@changestatus');

Route::get('/category', 'CategoryController@index')->name('category');
Route::POST('/cstore', 'CategoryController@store')->name('category.store');
Route::PUT('/cupdate/{id}', 'CategoryController@update')->name('category.update');
Route::get('/cedit/{id}', 'CategoryController@edit')->name('category.edit');


Route::get('/item', 'ItemController@index')->name('item');
Route::POST('/istore', 'ItemController@store')->name('item.store');
Route::PUT('/iupdate/{id}', 'ItemController@update')->name('item.update');
Route::get('/iedit/{id}', 'ItemController@edit')->name('item.edit');

Route::get('/project', 'ProjectController@index')->name('project');
Route::POST('/projstore', 'ProjectController@store')->name('project.store');
Route::PUT('/projupdate/{id}', 'ProjectController@update')->name('project.update');
Route::get('/projedit/{id}', 'ProjectController@edit')->name('project.edit');
//Route::get('/projshow', 'ProjectController@show')->name('project.show');

Route::get('/budget', 'BudgetController@index')->name('budget');
// By Senthoo
Route::get('/add_budget', 'BudgetController@addbudget')->name('add_budget');
Route::get('/show_cat_budget', 'BudgetController@show_cat_budget');
Route::get('/insert_budget', 'BudgetController@insert_budget');
Route::get('/complete_budget/{id}', 'BudgetController@complete_budget');



Route::POST('/budgstore', 'BudgetController@store')->name('budget.store');
Route::PUT('/budgupdate/{id}', 'BudgetController@update')->name('budget.update');
Route::get('/budgedit/{id}', 'BudgetController@edit')->name('budget.edit');
Route::get('/budgeview/{id}', 'BudgetController@show')->name('budget.show');

Route::get('/dsreport', 'DSReportController@index')->name('dsreport');
//Route::get('/dsradd', 'DSReportController@add')->name('dsreport.add');
Route::PUT('/addreceived', 'DSReportController@update')->name('dsreport.update');
Route::PUT('/addtrans', 'DSReportController@trans')->name('dsreport.trans');
Route::PUT('/addemployee', 'DSReportController@addemployee')->name('dsreport.addemployee');
Route::get('/loadData', 'DSReportController@loadData');

Route::get('/projcat', 'DSReportController@projcat');
Route::get('/catitem', 'DSReportController@catitem');
Route::get('/trans_catitem', 'DSReportController@trans_catitem');
Route::get('/projects_for_trans', 'DSReportController@projects_for_trans');
Route::get('/empdetails', 'DSReportController@empdetails');

//By Senthoo in Daily Report
Route::post('/addDailyprojets', 'DSReportController@insertDailyReports')->name('dsreport.add');
Route::get('/DailySiteUpdate/{id}', 'DSReportController@updateDailyReports')->name('dsreport.DailySiteUpdate');
Route::get('insert_received', 'DSReportController@insert_received');
Route::get('insert_transferred', 'DSReportController@insert_transferred');
Route::get('insert_emp_amount', 'DSReportController@insert_emp_amount');
