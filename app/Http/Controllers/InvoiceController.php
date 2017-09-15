<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 9/15/17
 * Time: 9:21 AM
 */

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