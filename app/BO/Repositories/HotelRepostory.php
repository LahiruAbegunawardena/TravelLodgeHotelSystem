<?php

namespace App\BO\Repositories;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\BO\Models\HotelModel;
use Illuminate\Database\QueryException;
use App\BO\Models\IndividualHotelRoomModel;

class HotelRepostory {
 
    protected $hotelModel;
    public function __construct(HotelModel $hotelModel) {
        $this->hotelModel = $hotelModel;
    }

    public function getAllHotels(){
        return $this->hotelModel->all();
    }

    public function getHotelById($hotel_id){
        return $this->hotelModel->where(["id" => $hotel_id])->first();
    }

    public function storeHotel(array $request){
        try {
            $newHotel = $this->hotelModel->create($request);
            if(isset($newHotel)){
                return $newHotel;
            } else {
                return null;
            }
        } catch (QueryException $ex) {
            return null;
        }
    }

    public function updateHotel(int $hotel_id, array $request){
        try {
            $slctdHotel = $this->getHotelById($hotel_id);
            if(isset($slctdHotel)){
                return $slctdHotel->update($request);
            } else {
                return null;
            }
        } catch (QueryException $ex) {
            return null;
        }
    }

    public function getRoomsByHotelId($hotel_id) {
        return IndividualHotelRoomModel::where(['hotels_id' => $hotel_id])->get();
    }

    public function updateHotelRooms(int $hotel_id, array $request){
        try {
            $slctdHotel = $this->getHotelById($hotel_id);
            $no_of_bed_rooms = $request["no_of_bed_rooms"];
            // $price_per_night = $request["price_per_night"];
            $count1 = count(IndividualHotelRoomModel::where(['no_of_beds' => 1, 'hotels_id' => $hotel_id])->get());
            $count2 = count(IndividualHotelRoomModel::where(['no_of_beds' => 2, 'hotels_id' => $hotel_id])->get());

            // dd($no_of_bed_rooms, $price_per_night);
            foreach ($no_of_bed_rooms as $key => $value) {
                if($key == 1){ 
                    $count = (int)$value - $count1;
                    $price_per_night = 2500.00;
                }
                if($key == 2){
                    $count = (int)$value - $count2;
                    $price_per_night = 4000.00;
                }
                for ($i=0; $i < $count; $i++) { 
                    $slctdHotel->individualHotelRooms()->insert(array(
                        'hotels_id' => $hotel_id,
                        'no_of_beds' => $key,
                        'is_ac' => 1,
                        'price_per_night' => (double)$price_per_night
                    ));
                }
                
            }
            return $slctdHotel;
        } catch (QueryException $ex) {
            dd($ex->getMessage());
        }
    }
}