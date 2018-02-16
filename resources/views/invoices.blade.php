@extends('layout')
<?php /** @var $invoices \App\Invoice[]  */ ?>
@section('content')
    <h2>Invoices</h2>
    @include('partials.invoices', ['invoices' => $invoices])
@endsection