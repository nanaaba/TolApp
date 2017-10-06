<?php

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

    return view('login');
});


Route::get('dashboard', 'DashboardController@showdashboard');
Route::get('configuration/category', 'ConfigurationController@showcategory');
Route::get('configuration/tollpoint', 'ConfigurationController@showtollpoint');
Route::get('configuration/cashier', 'ConfigurationController@showcashier');
Route::get('configuration/district', 'ConfigurationController@showdistrict');
Route::get('configuration/categories', 'ConfigurationController@showcategories');
Route::get('configuration/cashiers', 'ConfigurationController@showcashiers');
Route::get('configuration/tollpoints', 'ConfigurationController@showtollpoints');
Route::get('reports', 'ReportController@showreport');

Route::post('authenticateuser', 'LoginController@authenticateuser');
Route::post('searchresult', 'ReportController@spoolresult');
//savetoll
Route::post('savecategory', 'ConfigurationController@saveCategory');
Route::post('savecashier', 'ConfigurationController@saveCashier');
Route::post('savetoll', 'ConfigurationController@saveToll');

//savecashier
Route::get('gettollpoints', 'ConfigurationController@getTollpoints');
Route::get('getregions', 'ConfigurationController@getRegions');
Route::get('getdistricts', 'ConfigurationController@getDistricts');
Route::get('getcashiers', 'ConfigurationController@getCashiers');
Route::get('getcategories', 'ConfigurationController@getCategories');
Route::get('getdistricts/{regionid}', 'ConfigurationController@getRegionDistricts');
Route::get('dashboardreports', 'DashboardController@showdashboardreports');

//getcashiers
