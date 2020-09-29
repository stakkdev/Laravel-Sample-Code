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

Route::namespace('API\V1\Notification')->middleware('auth:api')->group(function () {
	Route::get('get-notification-count', 'NotificationController@getNotificationCount');
	Route::get('get-notifications', 'NotificationController@getNotifications');
});
