<?php

namespace App\BO\Repositories;

use Illuminate\Http\Request;
use App\BO\Models\IndividualHotelRoomModel;

class HotelRoomRepostory {
    protected $individualHotelRoomModel;
    public function __construct(IndividualHotelRoomModel $individualHotelRoomModel) {
        $this->individualHotelRoomModel = $individualHotelRoomModel;
    }

    public function getHotelRoomById($room_id){
        return $this->individualHotelRoomModel->find($room_id);
    }
}