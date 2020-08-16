<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\BO\Models\InvoiceModel;
use App\BO\Services\HotelService;
use App\BO\Services\CustomerService;
use App\Http\Controllers\Controller;
use App\BO\Services\HotelRoomService;
use Illuminate\Support\Facades\Validator;
use App\BO\Models\IndividualHotelRoomModel;

class HotelRoomController extends Controller
{
    protected $hotelService;
    protected $customerService;
    protected $hotelRoomService;

    public function __construct(CustomerService $customerService, HotelService $hotelService, HotelRoomService $hotelRoomService){
        $this->hotelService = $hotelService;
        $this->customerService = $customerService;
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

    public function getAvailableRooms(int $hotel_id, Request $request) {
        $validation = Validator::make($request->all(), [
            'checkin' => 'required',
            'checkout' => 'required'
        ]);
        if($validation->fails()){
            return redirect('/admin/hotels/'.$hotel_id.'/rooms')->with('info', $validation->errors());
        } else {
            $hotel = $this->hotelService->getHotelById($hotel_id);
            $hotelRooms = $hotel->individualHotelRooms;
            $checkin = strtotime($request["checkin"]." 12:00:00");
            $checkout = strtotime($request["checkout"]." 12:00:00");
            $available_hotel_rooms = [];
            foreach ($hotelRooms as $key => $hotelRoom) {
                $check = $this->hotelRoomService->checkIfRoomAvailable($checkin, $checkout, $hotelRoom);
                if($check){
                    $available_hotel_rooms[] = $hotelRoom;
                }
            }
            $data["hotel"] = $hotel;
            $data["customers"] = $this->customerService->getAllCustomers();
            $data["availableHotelRooms"] = $available_hotel_rooms;
            $data["checkin"] = $request["checkin"];
            $data["checkout"] = $request["checkout"];
            return view('admin.hotel-rooms.roomreserve', $data);
        }
    }

    public function reserveRooms(int $hotel_id, Request $request)
    {
        
        $rooms = $request["selectedHotelRooms"];
        $checkin = $request["checkin"]." 12:00:00";
        $checkout = $request["checkout"]." 12:00:00";
        $duration = date_diff(date_create($checkin), date_create($checkout));

        $customer = $this->customerService->getCustomerById($request->customer_id);

        $invoice = InvoiceModel::create([
            'total_price' => null, 
            'is_paid' => 0,
            'admins_id' => null
        ]);
        $total_payment = 0;

        foreach ($rooms as $room_id) {
            $room = IndividualHotelRoomModel::find($room_id);
            $payment = ($room->price_per_night) * ($duration->days);
            $total_payment += $payment;
            $customer->reserve()->attach($room_id, [
                'invoice_id' => $invoice->id,
                'checkin_date_time' => $checkin,
                'checkout_date_time' => $checkout,
                'reserved_date_time' => Carbon::now(),
                'price' => (double)$payment
            ]);
        }

        $curInvoice = InvoiceModel::find($invoice->id);
        $curInvoice->update([
            'total_price' => (double)$total_payment 
        ]);

        return redirect('/admin/invoice-list')->with('success', 'Reservation done successfuly..');    
    }
}
