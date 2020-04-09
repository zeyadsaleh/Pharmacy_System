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

// Route::get('/', 'MainController@index')->middleware('auth');

// Route::group([
//     'prefix'     => 'doctor',
//     'middleware' => ['role:doctor', 'auth'],
// ], function () {
// Route::get('/', 'DoctorController@index')->name('doctors.index');
// });

##########################route of doctor role#################################
################################################################################
Route::group(['middleware' => ['auth', 'is-ban']], function () {
    Route::get('/doctors', 'DoctorController@index')->name('doctors.index');

    // Main route for pharmacy with table of data
    Route::get('/pharmacies', 'PharmacyController@index')->name('pharmacies.index');
    Route::get('/pharmacies/doctors', 'PharmacyController@indexDoctors')->name('pharmacies.doctors.index');
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

    ##################################Revenue############################################

    Route::get('/revenues', 'RevenueController@index')->name('revenues.index');

    #################################################################################
});

################################Order#########################################

Route::get('/orders', 'OrderController@index')->name('orders.index');
Route::get('/orders/create', 'OrderController@create')->name('orders.create');
Route::post('/orders', 'OrderController@store')->name('orders.store');
Route::get('/orders/{order}/edit', 'OrderController@edit')->name('orders.edit');
Route::put('/orders/{order}', 'OrderController@update')->name('orders.update');
Route::delete('/orders/{order}', 'OrderController@destroy')->name('orders.destroy');
Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
##################################Revenue############################################

Route::get('/revenues', 'RevenueController@index')->name('revenues.index');

#################################################################################

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

####### Admin Route
Route::group([
    'prefix'     => 'admin',
    'middleware' => ['role:super-admin',],
], function () {
    ## Main page
    Route::get('/', 'AdminController@index')->name('admin.index');
    ## Areas
    Route::get('/areas', 'AreaController@index')->name('admin.areas.index');
    Route::get('/areas/create', 'AreaController@create')->name('admin.areas.create');
    Route::post('/areas/store', 'AreaController@store')->name('admin.areas.store');
    Route::get('/areas/{area}/edit', 'AreaController@edit')->name('admin.areas.edit');
    Route::put('/areas/{area}', 'AreaController@update')->name('admin.areas.update');
    Route::delete('/areas/{area}', 'AreaController@destroy')->name('admin.areas.destroy');
    ## Clients
    Route::get('/clients', 'ClientController@index')->name('admin.clients.index');
    Route::get('/clients/create', 'ClientController@create')->name('admin.clients.create');
    Route::post('/clients/store', 'ClientController@store')->name('admin.clients.store');
    Route::get('/clients/{client}/edit', 'ClientController@edit')->name('admin.clients.edit');
    Route::put('/clients/{client}', 'ClientController@update')->name('admin.clients.update');
    Route::delete('/clients/{client}', 'ClientController@destroy')->name('admin.clients.destroy');
    ## Medicine
    Route::get('/medicines', 'MedicineController@index')->name('medicines.index');
    Route::get('/medicines/create', 'MedicineController@create')->name('medicines.create');
    Route::post('/medicines/store', 'MedicineController@store')->name('medicines.store');
    Route::get('/medicines/{medicine}/edit', 'MedicineController@edit')->name('medicines.edit');
    Route::put('/medicines/{medicine}', 'MedicineController@update')->name('medicines.update');
    Route::delete('/medicines/{medicine}', 'MedicineController@destroy')->name('medicines.destroy');
    ## Pharmacy
    Route::get('/pharmacies', 'PharmacyController@indexPh')->name('admin.pharmacies.index');
    Route::get('/pharmacies/create', 'PharmacyController@createPh')->name('admin.pharmacies.create');
    Route::post('/pharmacies/store', 'PharmacyController@storePh')->name('admin.pharmacies.store');
    Route::get('/pharmacies/{pharmacy}/edit', 'PharmacyController@editPh')->name('admin.pharmacies.edit');
    Route::put('/pharmacies/{pharmacy}', 'PharmacyController@updatePh')->name('admin.pharmacies.update');
    Route::delete('/pharmacies/{pharmacy}', 'PharmacyController@destroyPh')->name('admin.pharmacies.destroy');
    Route::patch('/pharmacies/{pharmacy}', 'PharmacyController@restorePh')->name('admin.pharmacies.restore');
    Route::get('/pharmacies/deleted', 'PharmacyController@indexDeleted')->name('admin.pharmacies.deleted');
    ## User Addresses
    Route::get('/userAddresses', 'UsrAdrsController@index')->name('admin.userAddresses.index');
    Route::get('/userAddresses/create', 'UsrAdrsController@create')->name('admin.userAddresses.create');
    Route::post('/userAddresses/store', 'UsrAdrsController@store')->name('admin.userAddresses.store');
    Route::get('/userAddresses/{useraddresss}/edit', 'UsrAdrsController@edit')->name('admin.userAddresses.edit');
    Route::put('/userAddresses/{useraddress}', 'UsrAdrsController@update')->name('admin.userAddresses.update');
    Route::delete('/userAddresses/{useraddress}', 'UsrAdrsController@destroy')->name('admin.userAddresses.destroy');

});
