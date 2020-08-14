<?php

use Illuminate\Http\Request;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::POST('/customer/register', 'Api\CustomerApiController@registerCustomer');
Route::POST('/customer/login', 'Api\CustomerApiController@loginCustomer');

Route::middleware('auth:api')->group(function () {
    Route::POST('/customer/logout', 'Api\CustomerApiController@logout');
    Route::GET('/customer/profile', 'Api\CustomerApiController@profile');
    Route::GET('/hotel-list', 'Api\ReservationApiController@getHotelDetails');
    Route::POST('/rooms/reserve', 'Api\ReservationApiController@reserveRooms');
    Route::GET('/my-reservations', 'Api\ReservationApiController@myReservations');
});


