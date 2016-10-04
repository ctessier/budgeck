@extends('layouts/front')

@section('title', 'Historique')

@section('content')
<div class="ui grid">
    @include('menu.sidebar.history')
    <div class="twelve wide column">
        @if ($awaitings->count() === 0 && $transactions->count() === 0)
            <div class="ui segment">
                Aucune opération à afficher
            </div>
        @endif
        @if ($awaitings->count() > 0)
            <h3>Opérations en attente</h3>
            <table class="ui table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Intitulé</th>
                        <th>Budget</th>
                        <th>Montant</th>
                        <th style="width:5%"></th>
                    </tr>
                </thead>
                <tbody>
                {{--*/ $currentMonth = null /*--}}
                @foreach ($awaitings as $transaction)
                    {{--*/ $month = \Carbon\Carbon::createFromDate($transaction->year, $transaction->month, null) /*--}}
                    @if ($currentMonth !== $month->format('m'))
                        <!--<div class="month-separator">
                            {{ucfirst($month->formatLocalized('%B'))}}
                        </div>-->
                        {{--*/ $currentMonth = $month->format('m') /*--}}
                    @endif
                    <!--<div class="transaction awaiting {{$transaction->isExpense() ? 'expense' : 'income'}}">
                        <div class="transaction-date">{{$transaction->transaction_date->format('d/m/Y')}}</div>
                        <div class="transaction-title">{{$transaction->title}}</div>
                        <div class="transaction-amount">@amount($transaction->amount)</div>
                        <div class="transaction-actions">
                            {!! HTML::linkRoute('accounts.transactions.edit', 'Modifier', ['accounts' => $transaction->account_id, 'transactions' => $transaction->id], ['class' => 'btn-tiny radius', 'data-use-lightbox' => 'true']) !!}
                            {!! Form::open(['method' => 'delete', 'route' => ['accounts.transactions.destroy', $transaction->account_id, $transaction->id], 'style' => 'display:inline;', 'data-use-confirm' => 'true', 'data-confirm-message' => 'Souhaitez-vous définitivement supprimer cette transaction ?']) !!}
                                <a class="btn-tiny btn-red radius" data-form-submit="true">Supprimer</a>
                            {!! Form::close() !!}
                        </div>
                    </div>-->
                    <tr class="{{!$transaction->isExpense() ? 'positive' : ''}}">
                        <td>{{$transaction->transaction_date->format('d/m/Y')}}</td>
                        <td>{{$transaction->title}}</td>
                        <td>
                            @if ($transaction->budget)
                                <div class="ui small blue horizontal label">
                                    {{$transaction->budget->title}}
                                </div>
                            @endif
                        </td>
                        <td>@amount($transaction->amount)</td>
                        <td>
                            <div class="ui icon top left pointing dropdown mini settings-icon" style="display:none">
                                <i class="settings icon"></i>
                                <div class="menu">
                                    {!! HTML::linkRoute('accounts.transactions.edit', 'Modifier', ['accounts' => $transaction->account_id, 'transactions' => $transaction->id], ['class' => 'item', 'data-use-modal' => 'true']) !!}
                                    {!! Form::open(['method' => 'delete', 'route' => ['accounts.transactions.destroy', $transaction->account_id, $transaction->id], 'class' => 'item', 'data-use-confirm' => 'true', 'data-confirm-modal-title' => 'Supprimer la transaction', 'data-confirm-modal-message' => 'Souhaitez-vous définitivement supprimer cette transaction ?']) !!}
                                    <div type="submit">Supprimer</div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        @if ($transactions->count() > 0)
            <h3>Opérations terminées</h3>
            <table class="ui table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Intitulé</th>
                        <th>Budget</th>
                        <th>Montant</th>
                        <th style="width:5%"></th>
                    </tr>
                </thead>
                <tbody>
                {{--*/ $currentMonth = null /*--}}
                @foreach ($transactions as $transaction)
                    {{--*/ $month = \Carbon\Carbon::createFromDate($transaction->year, $transaction->month, null) /*--}}
                    @if ($currentMonth !== $month->format('m'))
                        <!--<div class="month-separator">
                            {{ucfirst($month->formatLocalized('%B'))}}
                        </div>-->
                        {{--*/ $currentMonth = $month->format('m') /*--}}
                    @endif
                    <!--<div class="transaction {{$transaction->isExpense() ? 'expense' : 'income'}}">
                        <div class="transaction-date">{{$transaction->transaction_date->format('d/m/Y') }}</div>
                        <div class="transaction-title">{{$transaction->title}}</div>
                        <div class="transaction-amount">@amount($transaction->amount)</div>
                        <div class="transaction-actions">
                            {!! HTML::linkRoute('accounts.transactions.edit', 'Modifier', ['accounts' => $transaction->account_id, 'transactions' => $transaction->id], ['class' => 'btn-tiny radius', 'data-use-lightbox' => 'true']) !!}
                            {!! Form::open(['method' => 'delete', 'route' => ['accounts.transactions.destroy', $transaction->account_id, $transaction->id], 'style' => 'display:inline;', 'data-use-confirm' => 'true', 'data-confirm-message' => 'Souhaitez-vous définitivement supprimer cette transaction ?']) !!}
                                <a class="btn-tiny btn-red radius" data-form-submit="true">Supprimer</a>
                            {!! Form::close() !!}
                        </div>
                    </div>-->
                    <tr class="{{!$transaction->isExpense() ? 'positive' : ''}}">
                        <td>{{$transaction->transaction_date->format('d/m/Y')}}</td>
                        <td>{{$transaction->title}}</td>
                        <td>
                            @if ($transaction->budget)
                            <div class="ui small blue horizontal label">
                                {{$transaction->budget->title}}
                            </div>
                            @endif
                        </td>
                        <td>@amount($transaction->amount)</td>
                        <td>
                            <div class="ui icon top left pointing dropdown mini settings-icon" style="display:none">
                                <i class="settings icon"></i>
                                <div class="menu">
                                    {!! HTML::linkRoute('accounts.transactions.edit', 'Modifier', ['accounts' => $transaction->account_id, 'transactions' => $transaction->id], ['class' => 'item', 'data-use-modal' => 'true']) !!}
                                    {!! Form::open(['method' => 'delete', 'route' => ['accounts.transactions.destroy', $transaction->account_id, $transaction->id], 'class' => 'item', 'data-use-confirm' => 'true', 'data-confirm-modal-title' => 'Supprimer la transaction', 'data-confirm-modal-message' => 'Souhaitez-vous définitivement supprimer cette transaction ?']) !!}
                                    <div type="submit">Supprimer</div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        <div class="ui floating labeled icon dropdown mini button">
            <i class="add icon"></i>
            <span class="text">Ajouter une transaction</span>
            <div class="menu">
                {!! HTML::linkRoute('accounts.transactions.create', 'Dépense', ['accounts' => $current_account->id], ['class' => 'item', 'data-use-modal' => 'true']) !!}
                {!! HTML::linkRoute('accounts.transactions.create', 'Revenu', ['accounts' => $current_account->id, 'income'], ['class' => 'item', 'data-use-modal' => 'true']) !!}
            </div>
        </div>
    </div>
</div>
<script>
    $('.dropdown').dropdown();

    $('tr').hover(function() {
        $(this).find('td .settings-icon').show();
    });
    $('tr').mouseleave(function() {
        var settingsIcon = $(this).find('td .settings-icon');
        if (!settingsIcon.hasClass('visible')) {
            $(this).find('td .settings-icon').hide();
        }
    });
</script>
@stop
