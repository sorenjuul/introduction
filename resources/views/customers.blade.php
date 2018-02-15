@extends('layout')
<?php /** @var $customers \App\Customer[]  */ ?>
@section('content')
    <h2>Customers</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Agreement</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
            <tr>
                <td><a href="/customer/{{ $customer->id }}">{{ $customer->number }}</a></td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->agreement->type }} DKK {{ $customer->agreement->unit_price }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection