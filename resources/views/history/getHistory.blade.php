@extends('layouts/front')

@section('title', 'Historique')

@section('content')
@include('menu.sidebar.accounts')
<div class="columns large-8">
    @if ($awaitings->count() === 0 && $transactions->count() === 0)
    <div class="alert align-center">
        Aucune transaction à afficher
    </div>
    @endif
    @if ($awaitings->count() > 0)
    <div class="content">
        <h3>Transactions en attente</h3>
        {{--*/ $currentMonth = null /*--}}
        @foreach ($awaitings as $awaiting)
        @if ($awaiting->isSpending())
        {{--*/ $month = \Carbon\Carbon::createFromFormat('m', $awaiting->budget->month) /*--}}
        @elseif ($awaiting->isIncome())
        {{--*/ $month = \Carbon\Carbon::createFromFormat('m', $awaiting->income->month) /*--}}
        @endif
        @if ($currentMonth !== $month->format('m'))
        <div class="month-separator">
            {{ucfirst($month->formatLocalized('%B'))}}
        </div>
        {{--*/ $currentMonth = $month->format('m') /*--}}
        @endif
        <div class="transaction awaiting {{$awaiting->budget_id !== null ? 'expense' : 'income'}}">
            <a href="{{route('transactions.getEdit', ['transaction_id' => $awaiting->id])}}" data-use-lightbox="true">
                <div class="transaction-date">{{date('d/m/Y', strtotime($awaiting->transaction_date))}}</div>
                <div class="transaction-title">{{$awaiting->title}}</div>
                <div class="transaction-amount">&euro; {{$awaiting->amount}}</div>
            </a>
        </div>
        @endforeach
    </div>
    @endif

    @if ($transactions->count() > 0)
    <div class="content">
        <h3>Transactions terminées</h3>
        {{--*/ $currentMonth = null /*--}}
        @foreach ($transactions as $transaction)
        @if ($transaction->isSpending())
        {{--*/ $month = \Carbon\Carbon::createFromFormat('m', $transaction->budget->month) /*--}}
        @elseif ($transaction->isIncome())
        {{--*/ $month = \Carbon\Carbon::createFromFormat('m', $transaction->income->month) /*--}}
        @endif
        @if ($currentMonth !== $month->format('m'))
        <div class="month-separator">
            {{ucfirst($month->formatLocalized('%B'))}}
        </div>
        {{--*/ $currentMonth = $month->format('m') /*--}}
        @endif
        <div class="transaction {{$transaction->budget_id !== null ? 'expense' : 'income'}}">
            <a href="{{route('transactions.getEdit', ['transaction_id' => $transaction->id])}}" data-use-lightbox="true">
                <div class="transaction-date">{{date('d/m/Y', strtotime($transaction->transaction_date))}}</div>
                <div class="transaction-title">{{$transaction->title}}</div>
                <div class="transaction-amount">&euro; {{$transaction->amount}}</div>
            </a>
        </div>
        @endforeach
    </div>
    @endif
</div>
@stop
