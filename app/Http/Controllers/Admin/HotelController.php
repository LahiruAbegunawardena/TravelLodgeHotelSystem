<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\BO\Services\HotelService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\BO\Models\IndividualHotelRoomModel;

class HotelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $hotelService;
    public function __construct(HotelService $hotelService){
        $this->hotelService = $hotelService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $data["hotelsData"] = $this->hotelService->getAllHotels();
        return view('admin.hotels.index', $data);
    }

    public function create(){
        return view('admin.hotels.create');
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'hotel_name' => 'required|string|max:255',
            'address' => 'required',
            'longitude' => 'required',
            'latitude' => 'required'
        ]);
        if($validation->fails()){
            return redirect()->route('hotelsIndex')->with('info', $validation->errors());
        } else {
            $newHotel = $this->hotelService->storeHotel($request);
            if(isset($newHotel)){
                return redirect()->route('hotelsIndex')->with('success', 'Hotel created successfuly..');
            } else {
                return redirect()->route('hotelsIndex')->with('warning', 'Failed hotel creation..');
            }
        }
    }

    public function editHotel(int $hotel_id){
        $data["hotel_data"] = $this->hotelService->getHotelById($hotel_id);
        $data["hotel_id"] = $hotel_id;
        // dd($data);
        return view('admin.hotels.edit', $data);
    }

    public function updateHotel(int $hotel_id, Request $request){
        $validation = Validator::make($request->all(), [
            'hotel_name' => 'required|string|max:255',
            'address' => 'required',
            'longitude' => 'required',
            'latitude' => 'required'
        ]);
        if($validation->fails()){
            return redirect()->route('hotelsIndex')->with('info', $validation->errors());
        } else {
            $newHotel = $this->hotelService->updateHotel($hotel_id, $request);
            if(isset($newHotel)){
                return redirect()->route('hotelsIndex')->with('success', 'Hotel updated successfuly..');
            } else {
                return redirect()->route('hotelsIndex')->with('warning', 'Failed hotel update..');
            }
        }
    }
}
