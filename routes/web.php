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

// Route::get('/', 'LoginC@index')->middleware('auth');

// Route::group([
//     'prefix'     => 'doctor',
//     'middleware' => ['role:doctor', 'auth'],
// ], function () {
// Route::get('/', 'DoctorController@index')->name('doctors.index');
// });

##########################Doctror#################################
################################################################################
Route::group(['middleware' => ['auth', 'is-ban']], function () {
    // Route::get('/doctors', 'DoctorController@index')->name('doctors.index');
    // Main route for pharmacy with table of data
    // Route::get('/pharmacies', 'PharmacyController@index')->name('pharmacies.index');
    // Route::get('/pharmacies/doctors', 'PharmacyController@indexDoctors')->name('pharmacies.doctors.index');
    // Route::get('/pharmacies/doctors/create', 'PharmacyController@createDoctors')->name('pharmacies.doctors.create');
    // Route::get('/pharmacies/revenues', 'PharmacyController@indexRevenues')->name('pharmacies.revenues.index');

    // Route::post('/pharmacies/doctors', 'PharmacyController@storeDoctors')->name('pharmacies.doctors.store');
    // Route::get('/pharmacies/doctors/{doctor}', 'PharmacyController@editDoctors')->name('pharmacies.doctors.edit');
    // Route::patch('/pharmacies/doctors/{doctor}', 'PharmacyController@updateDoctors')->name('pharmacies.doctors.update');
    // Route::delete('/pharmacies/doctors/{doctor}', 'PharmacyController@deleteDoctors')->name('pharmacies.doctors.delete');
    // Route::get('/unban/{doctor}', 'PharmacyController@unbanDoctors')->name('pharmacies.doctors.unban');
    // Route::get('/ban/{doctor}', 'PharmacyController@banDoctors')->name('pharmacies.doctors.ban');
    // Route to fetch data in json format from user table
    // Route::get('/pharmacy/doctors-dt', 'DoctorController@doctorsData')->name('pharmacy:doctors:dt');

    ##################################Doctor############################################
    Route::get('/doctors', 'DoctorController@index')->name('doctors.index');
    Route::get('doctors/create', 'DoctorController@create')->name('doctors.create');
    Route::post('/doctors', 'DoctorController@store')->name('doctors.store');
    Route::get('/doctors/{doctor}', 'DoctorController@edit')->name('doctors.edit');
    Route::patch('/doctors/{doctor}', 'DoctorController@update')->name('doctors.update');
    Route::delete('doctors/{doctor}', 'DoctorController@destroy')->name('doctors.destroy');
    Route::get('/unban/{doctor}', 'DoctorController@unbanDoctors')->name('doctors.unban');
    Route::get('/ban/{doctor}', 'DoctorController@banDoctors')->name('doctors.ban');
    // Route to fetch data in json format from user table
    Route::get('/doctors-dt', 'DoctorController@doctorsData')->name('doctors:dt');

    #################################################################################
});

Route::group(['middleware' => 'auth'], function () {
    ################################Order#########################################
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/orders/create', 'OrderController@create')->name('orders.create');
    Route::post('/orders', 'OrderController@store')->name('orders.store');
    Route::get('/orders/{order}/edit', 'OrderController@edit')->name('orders.edit');
    Route::delete('/orders/{order}', 'OrderController@destroy')->name('orders.destroy');
    Route::put('/orders/{order}', 'OrderController@update')->name('orders.update');
    Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');

    ##################################Revenue############################################

    Route::get('/revenues', 'RevenueController@index')->name('revenues.index');
});
#################################################################################
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
// Route::get('/', function() {
//     return redirect('/login');
// });

Route::get('/home', 'HomeController@index')->name('home');
## Pharmacy
Route::get('/pharmacies', 'PharmacyController@index')->name('pharmacies.index');
Route::get('/pharmacies/create', 'PharmacyController@create')->name('pharmacies.create');
Route::post('/pharmacies/store', 'PharmacyController@store')->name('pharmacies.store');
Route::get('/pharmacies/{pharmacy}/edit', 'PharmacyController@edit')->name('pharmacies.edit');
Route::put('/pharmacies/{pharmacy}', 'PharmacyController@update')->name('pharmacies.update');
Route::delete('/pharmacies/{pharmacy}', 'PharmacyController@destroy')->name('pharmacies.destroy');
Route::patch('/pharmacies/{pharmacy}', 'PharmacyController@restore')->name('pharmacies.restore');
Route::get('/pharmacies/deleted', 'PharmacyController@indexDeleted')->name('pharmacies.deleted');

Auth::routes();

Route::get('/checkout', 'CheckoutController@stripe')->name('stripe');
Route::post('/checkout', 'CheckoutController@pay')->name('stripe.pay');
####### Admin Route
Route::group([
    'prefix'     => 'admin',
    // 'middleware' => ['role:super-admin',],
], function () {
    ## Main page
    Route::get('/', 'AdminController@index')->name('admin.index');
    ## Areas
    Route::get('/areas', 'AreaController@index')->name('areas.index');
    Route::get('/areas/create', 'AreaController@create')->name('areas.create');
    Route::post('/areas/store', 'AreaController@store')->name('areas.store');
    Route::get('/areas/{area}/edit', 'AreaController@edit')->name('areas.edit');
    Route::put('/areas/{area}', 'AreaController@update')->name('areas.update');
    Route::delete('/areas/{area}', 'AreaController@destroy')->name('areas.destroy');
    ## Clients
    Route::get('/clients', 'ClientController@index')->name('clients.index');
    Route::get('/clients/create', 'ClientController@create')->name('clients.create');
    Route::post('/clients/store', 'ClientController@store')->name('clients.store');
    Route::get('/clients/{client}/edit', 'ClientController@edit')->name('clients.edit');
    Route::put('/clients/{client}', 'ClientController@update')->name('clients.update');
    Route::delete('/clients/{client}', 'ClientController@destroy')->name('clients.destroy');
    ## Medicine
    Route::get('/medicines', 'MedicineController@index')->name('medicines.index');
    Route::get('/medicines/create', 'MedicineController@create')->name('medicines.create');
    Route::post('/medicines/store', 'MedicineController@store')->name('medicines.store');
    Route::get('/medicines/{medicine}/edit', 'MedicineController@edit')->name('medicines.edit');
    Route::put('/medicines/{medicine}', 'MedicineController@update')->name('medicines.update');
    Route::delete('/medicines/{medicine}', 'MedicineController@destroy')->name('medicines.destroy');
    ## User Addresses
    Route::get('/userAddresses', 'UsrAdrsController@index')->name('userAddresses.index');
    Route::get('/userAddresses/create', 'UsrAdrsController@create')->name('userAddresses.create');
    Route::post('/userAddresses/store', 'UsrAdrsController@store')->name('userAddresses.store');
    Route::get('/userAddresses/{useraddresss}/edit', 'UsrAdrsController@edit')->name('userAddresses.edit');
    Route::put('/userAddresses/{useraddress}', 'UsrAdrsController@update')->name('userAddresses.update');
    Route::delete('/userAddresses/{useraddress}', 'UsrAdrsController@destroy')->name('userAddresses.destroy');
});
