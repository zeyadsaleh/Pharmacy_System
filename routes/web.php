<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Auth::routes();

Route::get('password/reset/{token?}', 'Auth\ForgotPasswordController@showLinkRequestForm');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/doctors', 'DoctorController@index')->name('doctors.index');
});

// Main route for pharmacy with table of data
Route::get('/pharmacies', 'PharmacyController@index')->name('pharmacies.index');
Route::get('/pharmacies/doctors', 'PharmacyController@showDoctors')->name('pharmacies.doctors.show');
Route::get('/pharmacies/doctors/create', 'PharmacyController@createDoctors')->name('pharmacies.doctors.create');
Route::get('/pharmacies/revenues', 'PharmacyController@indexRevenues')->name('pharmacies.revenues.index');

Route::post('/pharmacies/doctors', 'PharmacyController@storeDoctors')->name('pharmacies.doctors.store');
Route::get('/pharmacies/doctors/{doctor}', 'PharmacyController@edit')->name('pharmacies.doctors.edit');
Route::patch('/pharmacies/doctors/{doctor}', 'PharmacyController@update')->name('pharmacies.doctors.update');
Route::delete('/pharmacies/doctors/{doctor}', 'PharmacyController@delete')->name('pharmacies.doctors.delete');
Route::get('/unban/{doctor}', 'PharmacyController@unban')->name('pharmacies.doctors.unban');
Route::get('/ban/{doctor}', 'PharmacyController@ban')->name('pharmacies.doctors.ban');
// Route to fetch data in json format from user table
Route::get('/pharmacies-doctors-dt', 'PharmacyController@doctorsData')->name('pharmacies:doctors:dt');

#################################################################################

Route::get('/orders', 'OrderController@index')->name('orders.index');
Route::get('/orders/create', 'OrderController@create')->name('orders.create');
Route::post('/orders', 'OrderController@store')->name('orders.store');
Route::get('/orders/{order}/edit', 'OrderController@edit')->name('orders.edit');
Route::put('/orders/{order}', 'OrderController@update')->name('orders.update');
Route::delete('/orders/{order}', 'OrderController@destroy')->name('orders.destroy');
// Route::get('/orders', 'SearchController@search')->name('search');

##################################Revenue############################################

Route::get('/revenues', 'RevenueController@index')->name('revenues.index');

#################################################################################

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


####### Admin Route
// Auth::routes();

Route::prefix('admin')->group(function () {
    ## login
    Route::get('/login', 'Auth\AdminController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminController@login')->name('admin.login.submit');
    Route::get('logout/', 'Auth\AdminController@logout')->name('admin.logout');
    ## Main page
    Route::get('/', 'AdminController@index')->name('admin.index');
    ## Doctor
    Route::get('/doctors', 'AdminController@indexDoctors')->name('admin.doctors.index');
    Route::get('/doctors/create', 'AdminController@createDoctor')->name('admin.doctors.create');
    Route::post('/doctors/store', 'AdminController@storeDoctor')->name('admin.doctors.store');
    ## Areas
    Route::get('/areas', 'AdminController@indexArea')->name('admin.areas.index');
    Route::get('/areas/create', 'AdminController@createArea')->name('admin.areas.create');
    Route::post('/areas/store', 'AdminController@storeArea')->name('admin.areas.store');
    Route::get('/areas/{area}/edit', 'AdminController@editArea')->name('admin.areas.edit');
    Route::put('/areas/{area}', 'AdminController@updateArea')->name('admin.areas.update');
    Route::delete('/areas/{area}', 'AdminController@destroyArea')->name('admin.areas.destroy');
    ## Users
    Route::get('/users', 'AdminController@indexUser')->name('admin.users.index');
    Route::get('/users/create', 'AdminController@createUser')->name('admin.users.create');
    Route::post('/users/store', 'AdminController@storeUser')->name('admin.users.store');
    Route::get('/users/{user}/edit', 'AdminController@editUser')->name('admin.users.edit');
    Route::put('/users/{user}', 'AdminController@updateUser')->name('admin.users.update');
    Route::delete('/users/{user}', 'AdminController@destroyUser')->name('admin.users.destroy');
    ## Pharmacy
    Route::get('/pharmacies', 'AdminController@indexPharmacy')->name('admin.pharmacies.index');
    Route::get('/pharmacies/create', 'AdminController@createPharmacy')->name('admin.pharmacies.create');
    Route::post('/pharmacies/store', 'AdminController@storePharmacy')->name('admin.pharmacies.store');
    Route::get('/pharmacies/{user}/edit', 'AdminController@editPharmacy')->name('admin.pharmacies.edit');
    Route::put('/pharmacies/{user}', 'AdminController@updatePharmacy')->name('admin.pharmacies.update');
    Route::delete('/pharmacies/{user}', 'AdminController@destroyPharmacy')->name('admin.pharmacies.destroy');
    ## User Addresses
    Route::get('/userAddresses', 'AdminController@indexUserAddress')->name('admin.userAddresses.index');
    Route::get('/userAddresses/create', 'AdminController@createUserAddress')->name('admin.userAddresses.create');
    Route::post('/userAddresses/store', 'AdminController@storeUserAddress')->name('admin.userAddresses.store');
    Route::get('/userAddresses/{usraddresss}/edit', 'AdminController@editUserAddress')->name('admin.userAddresses.edit');
    Route::put('/userAddresses/{usraddress}', 'AdminController@updateUserAddress')->name('admin.userAddresses.update');
    Route::delete('/userAddresses/{usraddress}', 'AdminController@destroyUserAddress')->name('admin.userAddresses.destroy');

});
#######
