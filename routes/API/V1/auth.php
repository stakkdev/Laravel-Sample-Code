<?php

use Illuminate\Support\Facades\Route;

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

Route::namespace('API\V1\Auth')->group(function () {
    Route::POST('login','AuthController@login');
    Route::POST('register','AuthController@register');

    Route::POST('sendOTP','OtpController@sendOTP');
    Route::POST('verifyOTP','OtpController@verifyOTP');
});

Route::namespace('API\V1\Auth')->middleware('auth:api')->group(function () {
	Route::GET('logout','AuthController@logout');
    Route::POST('uploadImage','AuthController@uploadImage');
});
