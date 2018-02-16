<?php /** @var $invoices \App\Invoice[]  */ ?>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Due</th>
            <th>Amount</th>
            <th>Customer</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->invoice_no}}</td>
            <td>{{ $invoice->invoice_due_at }}</td>
            <td>{{ $invoice->amount}}</td>
            <td>{{ $invoice->customer->name }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>