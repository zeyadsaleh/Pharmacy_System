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
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/doctors', 'DoctorController@index')->name('doctors.index');
});

// Main route for pharmacy with table of data
Route::get('/pharmacies', 'PharmacyController@index')->name('pharmacies.index');
Route::get('/pharmacies/doctors', 'PharmacyController@showDoctors')->name('pharmacies.doctors.show');
Route::get('/pharmacies/doctors/create', 'PharmacyController@createDoctors')->name('pharmacies.doctors.create');

// Route to fetch data in json format from user table
Route::get('/pharmacies-doctors-dt', 'PharmacyController@doctorsData')->name('pharmacies:doctors:dt');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
