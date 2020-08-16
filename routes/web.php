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
    if(!Auth::guard('web')->user()){
        return view('welcome');
    }
    return redirect()->route('hotelsIndex');
});

// Auth::routes();
Auth::routes(['register' => false]);

// Route::get('/home', 'HomeController@index')->name('home');
Route::POST('/customer/register', 'Customer\CustomerController@registerCustomer')->name('customerRegister');
Route::middleware('auth:web')->group(function () {

    Route::get('/admin/hotels', 'Admin\HotelController@index')->name('hotelsIndex');
    Route::get('/admin/hotels/create', 'Admin\HotelController@create')->name('hotelsCreate');
    Route::post('/admin/hotels/store', 'Admin\HotelController@store')->name('hotelStore');
    Route::get('/admin/hotels/{hotel_id}/edit', 'Admin\HotelController@editHotel');
    Route::put('/admin/hotels/{hotel_id}/update', 'Admin\HotelController@updateHotel')->name('updateHotel');

    Route::get('/admin/hotels/{hotel_id}/rooms', 'Admin\HotelRoomController@viewHotelRooms')->name('hotelRooms');
    Route::post('/admin/hotels/{hotel_id}/update-rooms', 'Admin\HotelRoomController@updateHotelRooms')->name('updateRooms');
    Route::get('/admin/hotel-room/{room_id}/check-availability', 'Admin\HotelRoomController@checkAvailabities');

    Route::get('/admin/customers', 'Admin\CustomerController@index')->name('customersIndex');
    Route::get('/admin/customer/{customer_id}/reservations', 'Admin\CustomerController@checkReservations');
    
    Route::get('/admin/invoice-list', 'Admin\InvoiceController@getAllInvoices')->name('invoice-list');
    Route::get('/admin/invoice/{invoice_id}/settle', 'Admin\InvoiceController@settleBill');
});