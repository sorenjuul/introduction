@extends('layout')
<?php /** @var $customer \App\Customer  */ ?>
@section('content')
    <h2>{{$customer->name}}</h2>
    <div>DKK {{$customer->agreement->unit_price}} {{$customer->agreement->type}}</div>
    <form method="get" action="/customer/invoice/{{$customer->id}}">
        <input type="submit" value="Invoice customer" />
    </form>
    <hr/>
    <h3>{{$customer->name}}'s invoices</h3>
    @include('partials.invoices', ['invoices' => $invoices])
@endsection