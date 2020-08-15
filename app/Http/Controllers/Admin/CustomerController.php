<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\BO\Services\HotelService;
use App\BO\Services\CustomerService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\BO\Models\IndividualHotelRoomModel;

class CustomerController extends Controller
{
    protected $customerService, $hotelService;
    public function __construct(CustomerService $customerService, HotelService $hotelService){
        $this->customerService = $customerService;
        $this->hotelService = $hotelService;
    }

    public function index(){
        $data["customers"] = $this->customerService->getAllCustomers();
        return view('admin.customers.index', $data);
    }

    public function checkReservations(int $customer_id) {
        $customer = $this->customerService->getCustomerById($customer_id);
        $data['customer'] = $customer;
        $reservationData = [];
        foreach ($customer->reserve as $key => $reservation) {
            $obj = $reservation;
            $obj->reservation = $reservation->pivot;
            $obj->hotelname = $this->hotelService->getHotelById($reservation->hotels_id)->hotel_name;
            $reservationData[] = $obj;

        }
        $data['reservations'] = $reservationData;
        return view('admin.customers.reservations', $data);
    }
}
