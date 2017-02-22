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
                        <th></th>
                        <th>Date</th>
                        <th>Intitulé</th>
                        <th>Budget</th>
                        <th>Montant</th>
                        <th style="width:5%"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($awaitings as $transaction)
                    <tr class="{{!$transaction->isExpense() ? 'positive' : ''}}">
                        <td>{{$transaction->transaction_date->format('d/m/Y')}}</td>
                        <td>
                            @if ($transaction->recurrent_transaction)
                                <i class="history icon"></i>
                            @endif
                            {{$transaction->title}}
                        </td>
                        <td>
                            @if ($transaction->budget)
                                <div class="ui small blue horizontal label">
                                    {{$transaction->budget->title}}
                                </div>
                            @endif
                        </td>
                        <td>@amount($transaction->amount)</td>
                        <td>
                            <div class="ui icon top left pointing dropdown mini settings-icon">
                                <i class="angle down icon"></i>
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
                @foreach ($transactions as $transaction)
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
                            <div class="ui icon top left pointing dropdown mini settings-icon">
                                <i class="angle down icon"></i>
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
            @include('pagination.default', ['paginator' => $transactions])
        @endif
    </div>
</div>
<script>
    $('.settings-icon').dropdown({
        action: "hide"
    });
    $('#add-transaction-dropdown').dropdown({
        action: "hide"
    });
</script>
@stop
