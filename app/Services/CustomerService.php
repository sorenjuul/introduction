<?php

namespace App\Services;

use App\Customer;
use App\Delivery;
use App\Invoice;
use App\Agreement;
use Carbon\Carbon;

class CustomerService {
    static function invoice($customer) {
        // Create invoice for customer
        $daysBack = $customer->agreement->type == Agreement::TYPE_WEEKLY ? 7 : 31;
        // get all deliveries that has not yet been invoiced
        $deliveriesQuery = Delivery::where([
                ['invoice_id', null],
                ['customer_id', $customer->id],
                ['delivered_at', '>', Carbon::now()->subDays($daysBack)]
            ]);
        $deliveries = $deliveriesQuery->get();

        if (count($deliveries) == 0) {
            return null;
        }

        // calculate the invoice amount
        global $unitPrice;
        $unitPrice = $customer->agreement->unit_price;
        $amount = $deliveries->reduce(function ($carry, $delivery) {
            global $unitPrice;
            return $carry + $delivery->count*$unitPrice;
        }, 0);

        $invoice = new Invoice();
        $invoice->customer_id = $customer->id;
        $invoice->agreement_id = $customer->agreement->id;
        $invoice->amount = $amount;
        $invoice->invoice_no = 0; // dummy number
        $invoice->invoice_due_at = Carbon::now()->addDays(30)->toDateTimeString();
        $invoice->save();
        // save once more to be able to set invoice number by id
        $invoice->invoice_no = 0; // dummy number to be able to set invoice number in the model by id
        $invoice->save();
        
        // set all deliveries as invoiced
        $deliveriesQuery->update(['invoice_id' => $invoice->id]);
        return $invoice;
    }
}