<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Support\Facades\View;

class InvoiceController
{
    public function index()
    {
        $invoices = Invoice::all();
        return View::make('invoices', compact('invoices'));
    }
}