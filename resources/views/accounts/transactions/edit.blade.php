@extends('layouts.lightbox')

@section('content')
    {!! Form::model($transaction, ['method' => 'put', 'route' => ['accounts.transactions.update', $current_account->id, $transaction->id], 'data-ajax-form' => 'true']) !!}
    @if ($transaction->transaction_type_id == \Budgeck\Models\TransactionType::INCOME)
        @include('accounts.transactions.form-income')
    @else
        @include('accounts.transactions.form-expense')
    @endif
    {!! Form::close() !!}
@stop
