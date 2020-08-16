<?php

namespace App\BO\Services;

use App\CommonBase\Service;
use Illuminate\Http\Request;
use App\BO\Models\IndividualHotelRoomModel;
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
    public function checkIfRoomAvailable(int $checkin, int $checkout, IndividualHotelRoomModel $hotelRoom) {
        $check = true;
        foreach ($hotelRoom->reservations as $key2 => $reservation) {
            $reservation_checkIn  = strtotime($reservation->checkin_date_time);
            $reservation_checkOut = strtotime($reservation->checkout_date_time);
                
            if(($checkin<=$reservation_checkIn)){
                // current reservation checkin after or at same time to your checkin
                if($reservation_checkIn<$checkout){
                    // current reservation checkin before your checkout
                    $check = false;
                    break;
                }

                if($reservation_checkOut<=$checkout){
                    // current reservation checkouts before or at same to your checkout
                    $check = false;
                    break;
                }
            }

            if($checkin>=$reservation_checkIn && $checkin<$reservation_checkOut){
                //your checkin is between current reservation checkin & checkout
                $check  = false;
                break;
            }
        }
        return $check;
    }
}