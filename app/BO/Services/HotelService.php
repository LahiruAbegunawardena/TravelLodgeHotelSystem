<?php

namespace App\BO\Services;

use App\Student;
use App\CommonBase\Service;
use Illuminate\Http\Request;
use App\BO\Repositories\HotelRepostory;

class HotelService extends Service {

    // use CourseTransformable;
    protected $hotelRepostory;
    public function __construct(HotelRepostory $hotelRepostory) {
        $this->hotelRepostory = $hotelRepostory;
    }
 
    public function getAllHotels(){
        $hotels = $this->hotelRepostory->getAllHotels();
        return $hotels;
    }

    public function getHotelById($hotel_id){
        return $this->hotelRepostory->getHotelById($hotel_id);
    }

    public function getRoomsByHotelId($hotel_id) {
        return $this->hotelRepostory->getRoomsByHotelId($hotel_id);
    }

    public function storeHotel(Request $request){
        $hotel = $this->hotelRepostory->storeHotel($request->request->all());
        return $hotel;
    }

    public function updateHotel(int $hotel_id, Request $request){
        $hotel = $this->hotelRepostory->updateHotel($hotel_id, $request->request->all());
        return $hotel;
    }

    public function updateHotelRooms(int $hotel_id, Request $request){
        return $this->hotelRepostory->updateHotelRooms($hotel_id, $request->request->all());
    }
}