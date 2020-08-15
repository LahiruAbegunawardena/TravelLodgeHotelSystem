<?php

namespace App\BO\Repositories;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\BO\Models\InvoiceModel;
use Illuminate\Database\QueryException;

class InvoiceRepostory {
 
    protected $invoiceModel;
    public function __construct(InvoiceModel $invoiceModel) {
        $this->invoiceModel = $invoiceModel;
    }

    public function getAllInvoices(){
        return $this->invoiceModel->all();
    }
    public function settleBill($invoice_id) {
        try {
            $invoice = $this->invoiceModel->find($invoice_id);
            // dd($invoice, Auth::guard('web')->user()->id);
            return $invoice->update([
                "is_paid" => 1,
                "admins_id" => Auth::guard('web')->user()->id
            ]);
        } catch (QueryException $ex) {
            return null;
        }
    }
}