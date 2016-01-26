@extends('layouts/front')

@section('title', 'Historique')

@section('content')
@include('menu.sidebar.accounts')
<div class="columns large-8">
    @if ($awaitings->count() > 0)
    <div class="content">
        <h3>Transactions en attente</h3>
        @foreach ($awaitings as $awaiting)
        {{$awaiting->transaction_date}} {{$awaiting->title}} &euro;{{$awaiting->amount}}
        <br />
        @endforeach
    </div>
    @endif
    
    @if ($transactions->count() > 0)
    <div class="content">
        <h3>Transactions terminées</h3>
        @foreach ($transactions as $transaction)
        {{$transaction->effective_date}} {{$transaction->title}} &euro;{{$transaction->amount}}
        <br />
        @endforeach
    </div>
    @endif
</div>
@stop
