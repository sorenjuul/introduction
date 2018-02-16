<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Delivery;
use App\Invoice;
use App\Services\CustomerService;
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
        $customer = Customer::findOrFail($id);
        CustomerService::invoice( $customer);
        return Redirect::action('CustomerController@show',['id' => $id]);
    }
}
