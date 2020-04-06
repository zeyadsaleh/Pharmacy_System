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

Route::post('/pharmacies/doctors', 'PharmacyController@storeDoctors')->name('pharmacies.doctors.store');
Route::get('/pharmacies/doctors/{doctor}', 'PharmacyController@edit')->name('pharmacies.doctors.edit');
Route::patch('/pharmacies/doctors/{doctor}', 'PharmacyController@update')->name('pharmacies.doctors.update');
Route::delete('/pharmacies/doctors/{doctor}', 'PharmacyController@delete')->name('pharmacies.doctors.delete');
// Route::get('/pharmacies/doctors/{doctor}', 'PharmacyController@ban')->name('pharmacies.doctors.ban');
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

#################################################################################

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

####### Admin Route
Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/doctors', 'AdminController@indexDoctors')->name('admin.doctors.index');
    Route::get('/doctors/create', 'AdminController@createDoctor')->name('admin.doctors.create');
    Route::post('/doctors/store', 'AdminController@storeDoctor')->name('admin.doctors.store');
});
#######
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
