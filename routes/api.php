<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\User;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\ValidationException;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'API\ClientController@login');
Route::post('/register', 'API\ClientController@register');
// Has to be post not put but add in body __method and value set to PUT
Route::post('/clients/{client}', 'API\ClientController@update')->middleware('auth:sanctum');

Route::get('/orders', 'API\OrderController@index');
####The Field attribute of Post and Put should be: medicine1 , medicine2 .. and quantity1, quantity2 .. so on
Route::get('/orders/create', 'API\OrderController@create');
Route::post('/orders', 'API\OrderController@store');
Route::put('/orders/{order}', 'API\OrderController@update');
Route::get('/orders/{order}', 'API\OrderController@show');
// Route::delete('/orders/{order}', 'API\OrderController@destroy');

##################################ClientAddresses####################################
Route::get('/addresses', 'API\AddressController@index')->middleware('auth:sanctum');
Route::get('/addresses/{address}', 'API\AddressController@show')->middleware('auth:sanctum');
Route::put('/addresses/{address}', 'API\AddressController@update')->middleware('auth:sanctum');
Route::post('/addresses/{address}', 'API\AddressController@store')->middleware('auth:sanctum');
Route::delete('/addresses/{address}', 'API\AddressController@delete')->middleware('auth:sanctum');
######################################################################################

