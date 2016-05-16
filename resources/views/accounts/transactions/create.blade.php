@extends('layouts.lightbox')

@section('content')
    {!! Form::open(['method' => 'post', 'route' => ['accounts.transactions.store', $current_account->id], 'data-ajax-form' => 'true']) !!}
    @if (isset($income))
        @include('accounts.transactions.form-income')
    @else
        @include('accounts.transactions.form-expense')
    @endif
    {!! Form::close() !!}
@stop
