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
    return view('fontindex');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
 Route::post('/login/admin', 'Auth\LoginController@adminLogin');
 Route::post('/login/superadmin', 'Auth\LoginController@superadmin');
 Route::get('/login/superadmin', 'Auth\LoginController@showSuperadminLoginForm');
 Route::post('/register/admin', 'Auth\RegisterController@createAdmin');



Route::group(
    [
    'prefix' =>'superadmin',
    'namespace' =>'Superadmin',
    'middleware' => 'auth:superadmin'
    ], function() {
    Route::resource('dashboard', 'DashboardController');
  Route::resource('permission', 'PermissionsController');  /* Permission */
  Route::resource('role', 'RoleController');  /* Role for admin */
   Route::post('adminstatus', 'AdminController@setapproval'); /*admin set active inactive */
   Route::resource('admin', 'AdminController'); /*admin show */
   //Route::get('admin/edit/{id}', 'AdminController@edit'); /*admin show */
    Route::post('showpermission', 'AdminController@showpermission'); /*admin show permission*/
    Route::resource('gender', 'GenderController'); /*for gender*/
    Route::resource('status', 'StatusController'); /*for Active Status*/
    Route::resource('createadmin', 'AdminController');
    Route::Post('getproduct','SaleController@selectproduct');
    Route::post('delete/{id}','SaleController@delete');
     
    Route::get('invoiceedit/{id}', 'PinvoiceController@invoiceedit');
   
    Route::Post('bestsalewarehousereport','ReportController@bestsalewarehousereport');

    });



Route::group(
    [
    'prefix' =>'admin',
    'namespace' =>'Admin',
    'middleware' => 'auth:admin'
    ], function(){
    Route::resource('dashboard', 'DashboardController');
   
    
    Route::Post('getproduct','SaleController@selectproduct');
    Route::post('delete/{id}','SaleController@delete');
     
    Route::get('invoiceedit/{id}', 'PinvoiceController@invoiceedit');
   
    Route::Post('bestsalewarehousereport','ReportController@bestsalewarehousereport');

    });








