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