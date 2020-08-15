<?php

namespace App\BO\Services;

use App\CommonBase\Service;
use Illuminate\Http\Request;
use App\BO\Repositories\InvoiceRepostory;
use App\BO\Models\IndividualHotelRoomModel;

class InvoiceService extends Service {

    // use CourseTransformable;
    protected $invoiceRepostory;
    public function __construct(InvoiceRepostory $invoiceRepostory) {
        $this->invoiceRepostory = $invoiceRepostory;
    }

    public function getAllInvoices(){
        $invoices = $this->invoiceRepostory->getAllInvoices();
        $invoicesArr = [];
        foreach ($invoices as $key => $invoice) {
            $obj = $invoice;
            $obj->total_price_format = number_format($invoice->total_price, 2, ".", "");
            $reservations = $invoice->reservations;
            $obj->checkin_date_time = ($reservations[0]->checkin_date_time) ? $reservations[0]->checkin_date_time : null;
            $obj->checkout_date_time = ($reservations[0]->checkout_date_time) ? $reservations[0]->checkout_date_time : null;
            $obj->reserved_date_time = ($reservations[0]->reserved_date_time) ? $reservations[0]->reserved_date_time : null;
            $hotel_room_id = $reservations[0]->individual_hotel_room_id;
            $obj->hotel = IndividualHotelRoomModel::find($hotel_room_id)->belongedHotel;
            $obj->reservations = $reservations;
            $invoicesArr[] = $obj;
        }
        return $invoicesArr;
    }

    public function settleBill($invoice_id) {
        return $this->invoiceRepostory->settleBill($invoice_id);
    }
}