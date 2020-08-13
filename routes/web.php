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
    if(!Auth::guard('web')){
        return view('welcome');
    }
    return redirect()->route('hotelsIndex');
});

Auth::routes();
// Auth::routes(['register' => false]);

// Route::get('/home', 'HomeController@index')->name('home');
Route::POST('/customer/register', 'Customer\CustomerController@registerCustomer')->name('customerRegister');
Route::middleware('auth:web')->group(function () {
    Route::get('/admin/hotels', 'Admin\HotelController@index')->name('hotelsIndex');
    Route::get('/admin/hotels/create', 'Admin\HotelController@create')->name('hotelsCreate');
    Route::post('/admin/hotels/store', 'Admin\HotelController@store')->name('hotelStore');
});