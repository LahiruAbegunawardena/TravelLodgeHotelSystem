<?php

namespace App\BO\Services;

use App\CommonBase\Service;
use Illuminate\Http\Request;
use App\BO\Repositories\CustomerRepostory;

class CustomerService extends Service {

    // use CourseTransformable;
    protected $customerRepostory;
    public function __construct(CustomerRepostory $customerRepostory) {
        $this->customerRepostory = $customerRepostory;
    }
 
    public function getAllCustomers(){
        $customers = $this->customerRepostory->getAllCustomers();
        return $customers;
    }

    
}