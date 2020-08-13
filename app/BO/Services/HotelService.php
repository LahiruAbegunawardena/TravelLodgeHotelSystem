<?php

namespace App\BO\Services;

use App\Student;
use App\CommonBase\Service;
use App\BO\Repositories\HotelRepostory;
use Illuminate\Http\Request;

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

    public function storeHotel(Request $request){
        $hotel = $this->hotelRepostory->storeHotel($request->request->all());
        return $hotel;
    }
}