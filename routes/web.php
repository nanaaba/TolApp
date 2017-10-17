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
Route::get('/logout', function() {
    Session::flush();

    return redirect('/');
});
Route::post('authenticateuser', 'LoginController@authenticateuser');

Route::group(['middleware' => 'check-userauth'], function () {

    //display views   

    Route::get('dashboard', 'DashboardController@showdashboard');
    Route::get('configuration/category', 'ConfigurationController@showcategory');
    Route::get('configuration/tollpoint', ['middleware' => 'check-userauth', 'uses' => 'ConfigurationController@showtollpoint']);
    Route::get('configuration/cashier', 'ConfigurationController@showcashier');
    Route::get('configuration/district', 'ConfigurationController@showdistrict');
    Route::get('configuration/categories', 'ConfigurationController@showcategories');
    Route::get('configuration/cashiers', 'ConfigurationController@showcashiers');
    Route::get('configuration/tollpoints', 'ConfigurationController@showtollpoints');
    Route::get('reports/general', 'ReportController@showreport');
    Route::get('reports/yearly', 'ReportController@showyearlyreport');
    Route::get('reports/monthly', 'ReportController@showmonthlyreport');
    Route::get('reports/daily', 'ReportController@showdailyreport');
    Route::get('reports/shift', 'ReportController@showshiftreport');
    Route::get('users', 'UserController@showusers');




//apis
//report apis     
    Route::post('reports/searchresult', 'ReportController@spoolresult');
    Route::post('reports/yearlyreport', 'ReportController@yearlyreport');
    Route::post('reports/monthlyreport', 'ReportController@monthlyreport');
    Route::post('reports/dailyreport', 'ReportController@daywisereport');
    Route::post('reports/shiftreport', 'ReportController@shiftreport');

//configuration apis
//vehicle types apis
    Route::get('configuration/getcategories', 'ConfigurationController@getCategories');
    Route::get('configuration/category/{id}', 'ConfigurationController@getCategoryInformation');
    Route::post('configuration/savecategory', 'ConfigurationController@saveCategory');
    Route::put('configuration/updatecategory', 'ConfigurationController@updateCategory');
    Route::delete('configuration/deletecategory/{id}', 'ConfigurationController@deleteCategory');


//toll apis
    Route::get('configuration/gettollpoints', 'ConfigurationController@getTollpoints');
    Route::get('configuration/toll/{id}', 'ConfigurationController@getTollInformation');
    Route::post('configuration/savetoll', 'ConfigurationController@saveToll');
    Route::put('configuration/updatetoll', 'ConfigurationController@updateToll');
    Route::delete('configuration/deletetoll/{id}', 'ConfigurationController@deleteToll');


//cashier apis
    Route::get('configuration/getcashiers', 'ConfigurationController@getCashiers');
    Route::get('configuration/cashier/{id}', 'ConfigurationController@getCashierInformation');
    Route::post('configuration/savecashier', 'ConfigurationController@saveCashier');
    Route::put('configuration/updatecashier', 'ConfigurationController@updateCashier');
    Route::delete('configuration/deletecashier/{id}', 'ConfigurationController@deleteCashier');


//users apis
    Route::get('users/all', 'UserController@getUsers');
    Route::get('users/{userid}', 'UserController@userDetail');
    Route::post('users/save', 'UserController@saveUser');
    Route::delete('users/{userid}', 'UserController@deleteUser');
    Route::put('users/update', 'UserController@updateUser');


//other apis
    Route::get('getregions', 'ConfigurationController@getRegions');
    Route::get('getdistricts', 'ConfigurationController@getDistricts');
    Route::get('getdistricts/{regionid}', 'ConfigurationController@getRegionDistricts');
    Route::get('dashboardreports', 'DashboardController@showdashboardreports');

//getcashiers
});



