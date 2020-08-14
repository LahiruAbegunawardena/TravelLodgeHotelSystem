<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\BO\Services\CustomerService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\BO\Models\IndividualHotelRoomModel;

class CustomerController extends Controller
{
    protected $customerService;
    public function __construct(CustomerService $customerService){
        $this->customerService = $customerService;
    }

    public function index(){
        $data["customers"] = $this->customerService->getAllCustomers();
        return view('admin.customers.index', $data);
    }

    
}
