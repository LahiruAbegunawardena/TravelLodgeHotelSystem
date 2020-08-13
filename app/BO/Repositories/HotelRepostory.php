<?php

namespace App\BO\Repositories;

use Auth;
use Carbon\Carbon;
use App\BO\Models\HotelModel;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class HotelRepostory {
 
    protected $hotelModel;
    public function __construct(HotelModel $hotelModel) {
        $this->hotelModel = $hotelModel;
    }

    public function getAllHotels(){
        return $this->hotelModel->all();
    }

    public function storeHotel(array $request){
        try {
            // $hotelData = array(
            //     "hotel_name" => isset($request->hotel_name) ? $request->hotel_name : "",
            //     "address" => isset($request->address) ? $request->address : "",
            //     "longitude" => isset($request->longitude) ? $request->longitude : "",
            //     "latitude" => isset($request->latitude) ? $request->latitude : ""
            // );

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
}