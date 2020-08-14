<?php

namespace App\BO\Transformations;

use App\BO\Models\HotelModel;
use App\BO\Models\IndividualHotelRoomModel;

trait HotelTransformable
{
    public function transformHotelDet(HotelModel $hotelModel)
    {
        $obj = $hotelModel;
        $singleBedRoomsCount = 0;
        $doubleBedRoomsCount = 0;
        $individualHotelRooms = $hotelModel->individualHotelRooms;
        foreach ($individualHotelRooms as $key => $hotelRoom) {
            if($hotelRoom->no_of_beds == 1) { $singleBedRoomsCount++; }
            if($hotelRoom->no_of_beds == 2) { $doubleBedRoomsCount++; }
        }
        
        $obj->singleBedRoomsCount = $singleBedRoomsCount;
        $obj->doubleBedRoomsCount = $doubleBedRoomsCount;
        $obj->individual_hotel_rooms = $individualHotelRooms;
        return $obj;
    }

    public function transformHotelRoomDet(IndividualHotelRoomModel $hotelRoom)
    {
        $obj2 = $hotelRoom;
        $obj2->reservations = $hotelRoom->reservations;

        return $obj2;
    }

}
