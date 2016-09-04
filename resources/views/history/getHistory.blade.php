@extends('layouts/front')

@section('title', 'Historique')

@section('content')
    <div class="columns large-12">
        @if ($awaitings->count() === 0 && $transactions->count() === 0)
            <div class="alert align-center">
                Aucune opération à afficher
            </div>
        @endif
        @if ($awaitings->count() > 0)
            <div class="content">
                <h3>Opérations en attente</h3>
                {{--*/ $currentMonth = null /*--}}
                @foreach ($awaitings as $transaction)
                    {{--*/ $month = \Carbon\Carbon::createFromDate($transaction->year, $transaction->month, null) /*--}}
                    @if ($currentMonth !== $month->format('m'))
                        <div class="month-separator">
                            {{ucfirst($month->formatLocalized('%B'))}}
                        </div>
                        {{--*/ $currentMonth = $month->format('m') /*--}}
                    @endif
                    <div class="transaction awaiting {{$transaction->isExpense() ? 'expense' : 'income'}}">
                        <div class="transaction-date">{{$transaction->transaction_date->format('d/m/Y')}}</div>
                        <div class="transaction-title">{{$transaction->title}}</div>
                        <div class="transaction-amount">@amount($transaction->amount)</div>
                        <div class="transaction-actions">
                            {!! HTML::linkRoute('accounts.transactions.edit', 'Modifier', ['accounts' => $transaction->account_id, 'transactions' => $transaction->id], ['class' => 'btn-tiny radius', 'data-use-lightbox' => 'true']) !!}
                            {!! Form::open(['method' => 'delete', 'route' => ['accounts.transactions.destroy', $transaction->account_id, $transaction->id], 'style' => 'display:inline;', 'data-use-confirm' => 'true', 'data-confirm-message' => 'Souhaitez-vous définitivement supprimer cette transaction ?']) !!}
                                <a class="btn-tiny btn-red radius" data-form-submit="true">Supprimer</a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($transactions->count() > 0)
            <div class="content">
                <h3>Opérations terminées</h3>
                {{--*/ $currentMonth = null /*--}}
                @foreach ($transactions as $transaction)
                    {{--*/ $month = \Carbon\Carbon::createFromDate($transaction->year, $transaction->month, null) /*--}}
                    @if ($currentMonth !== $month->format('m'))
                        <div class="month-separator">
                            {{ucfirst($month->formatLocalized('%B'))}}
                        </div>
                        {{--*/ $currentMonth = $month->format('m') /*--}}
                    @endif
                    <div class="transaction {{$transaction->isExpense() ? 'expense' : 'income'}}">
                        <div class="transaction-date">{{$transaction->transaction_date->format('d/m/Y') }}</div>
                        <div class="transaction-title">{{$transaction->title}}</div>
                        <div class="transaction-amount">@amount($transaction->amount)</div>
                        <div class="transaction-actions">
                            {!! HTML::linkRoute('accounts.transactions.edit', 'Modifier', ['accounts' => $transaction->account_id, 'transactions' => $transaction->id], ['class' => 'btn-tiny radius', 'data-use-lightbox' => 'true']) !!}
                            {!! Form::open(['method' => 'delete', 'route' => ['accounts.transactions.destroy', $transaction->account_id, $transaction->id], 'style' => 'display:inline;', 'data-use-confirm' => 'true', 'data-confirm-message' => 'Souhaitez-vous définitivement supprimer cette transaction ?']) !!}
                                <a class="btn-tiny btn-red radius" data-form-submit="true">Supprimer</a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {!! HTML::linkRoute('accounts.transactions.create', 'Ajouter une dépense', ['accounts' => $current_account->id], ['class' => 'btn-tiny radius', 'data-use-lightbox' => 'true']) !!}
        {!! HTML::linkRoute('accounts.transactions.create', 'Ajouter un revenu', ['accounts' => $current_account->id, 'income'], ['class' => 'btn-tiny radius', 'data-use-lightbox' => 'true']) !!}
    </div>
@stop
