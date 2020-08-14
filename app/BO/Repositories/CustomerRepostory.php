<?php

namespace App\BO\Repositories;

use Auth;
use App\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\BO\Models\IndividualHotelRoomModel;

class CustomerRepostory {
 
    protected $customerModel;
    public function __construct(Customer $customerModel) {
        $this->customerModel = $customerModel;
    }

    public function getAllCustomers(){
        return $this->customerModel->all();
    }

    public function getCustomerById($customer_id){
        return $this->customerModel->find($customer_id);
    }

    
}