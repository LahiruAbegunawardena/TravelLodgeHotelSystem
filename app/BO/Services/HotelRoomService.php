<?php

namespace App\BO\Services;

use App\CommonBase\Service;
use Illuminate\Http\Request;
use App\BO\Repositories\HotelRoomRepostory;

class HotelRoomService extends Service {

    // use CourseTransformable;
    protected $hotelRoomRepostory;
    public function __construct(HotelRoomRepostory $hotelRoomRepostory) {
        $this->hotelRoomRepostory = $hotelRoomRepostory;
    }

    public function getHotelRoomById($room_id){
        return $this->hotelRoomRepostory->getHotelRoomById($room_id);
    }
}