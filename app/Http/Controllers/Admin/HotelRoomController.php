<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\BO\Services\HotelService;
use App\Http\Controllers\Controller;
use App\BO\Services\HotelRoomService;
use Illuminate\Support\Facades\Validator;
use App\BO\Models\IndividualHotelRoomModel;

class HotelRoomController extends Controller
{
    protected $hotelService;
    protected $hotelRoomService;
    public function __construct(HotelService $hotelService, HotelRoomService $hotelRoomService){
        $this->hotelService = $hotelService;
        $this->hotelRoomService = $hotelRoomService;
    }

    public function viewHotelRooms(int $hotel_id){
        $hotelData = $this->hotelService->getHotelById($hotel_id);
        $data["single_bedroom_count"] = count(IndividualHotelRoomModel::where(['no_of_beds' => 1, 'hotels_id' => $hotel_id])->get());
        $data["double_bedroom_count"] = count(IndividualHotelRoomModel::where(['no_of_beds' => 2, 'hotels_id' => $hotel_id])->get());
        $data["hotel_data"] = $hotelData;
        $data["hotel_rooms"] = $hotelData->individualHotelRooms;
        return view('admin.hotels.rooms', $data);

    }

    public function updateHotelRooms(int $hotel_id, Request $request){
        $hotelRoomData = $this->hotelService->updateHotelRooms($hotel_id, $request);
        return redirect('/admin/hotels/'.$hotel_id.'/rooms')->with('success', 'Hotel Rooms updated successfuly..');

    }

    public function checkAvailabities(int $room_id){
        $hotelRoom = $this->hotelRoomService->getHotelRoomById($room_id);
        $data["reservations"] = $hotelRoom->customers;
        return view('admin.hotel-rooms.reservations', $data);
    }

    
}
