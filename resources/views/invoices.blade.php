@extends('layout')
<?php /** @var $invoices \App\Invoice[]  */ ?>
@section('content')
    @include('partials.invoices', ['invoices' => $invoices])
@endsection