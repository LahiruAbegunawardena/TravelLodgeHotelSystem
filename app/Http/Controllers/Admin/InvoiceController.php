<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BO\Services\InvoiceService;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    protected $invoiceService;
    public function __construct(InvoiceService $invoiceService){
        $this->invoiceService = $invoiceService;
    }

    public function getAllInvoices() {
        $data["invoices"] = $this->invoiceService->getAllInvoices();
        
        return view('admin.invoices.index', $data);
    }

    public function settleBill($invoice_id) {
        $settled = $this->invoiceService->settleBill($invoice_id);
        if(isset($settled)){
            return redirect()->route('invoice-list')->with('success', 'Invoice settled successfully..');
        } else {
            return redirect()->route('invoice-list')->with('warning', 'Failed payment. Please check again..');
        }
    }
}
