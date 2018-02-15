<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Delivery;
use App\Invoice;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return View::make('customers', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $invoices = Invoice::where('customer_id', $id)->get();
        return View::make('customer', compact('customer', 'invoices'));
    }

    public function invoice($id)
    {
        // Create invoice for customer
        $customer = Customer::findOrFail($id);
        $deliveries = Delivery::where([
                ['invoice_id', null],
                ['customer_id', $id]
            ])->get();
        global $unitPrice;
        $unitPrice = $customer->agreement->unit_price;
        $amount = $deliveries->reduce(function ($carry, $delivery) {
            global $unitPrice;
            return $carry + $delivery->count*$unitPrice;
        }, 0);

        $invoice = new Invoice();
        $invoice->customer_id = $id;
        $invoice->agreement_id = $customer->agreement->id;
        $invoice->invoice_no = 0;
        $invoice->amount = $amount;
        $invoice->invoice_due_at = Carbon::now()->addDays(30)->toDateTimeString();
        $invoice->save();

        return Redirect::action('CustomerController@show',['id' => $id]);
    }
}
