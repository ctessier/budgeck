@extends('layouts.front')

@section('title', 'Suivi mensuel')

@section('content')
<div class="ui grid">
    @include('menu.sidebar.months')
    <div class="twelve wide column">
        <div class="ui segment">
            <h3>{{ $month_title }}</h3>
            @if ($budgets->count() === 0)
                <div class="alert align-center">
                    Aucun budget à afficher
                </div>
            @else
                <div class="ui three doubling cards">
                    @foreach ($budgets as $budget)
                        {{--*/ $progressPourcent = min(100, ($budget->getAmountSpent() / $budget->amount) * 100) /*--}}
                        <div class="card">
                            <div class="content">
                                <div class="right floated meta">
                                    <div class="ui icon top left pointing dropdown mini settings-icon">
                                        <i class="angle down icon"></i>
                                        <div class="menu">
                                            {!! HTML::linkRoute('accounts.budgets.show', 'Détails', ['accounts' => $current_account, 'budgets' => $budget], ['class' => 'item', 'data-use-modal' => 'true']) !!}
                                            {!! HTML::linkRoute('accounts.budgets.edit', 'Modifier', ['accounts' => $current_account, 'budgets' => $budget], ['class' => 'item', 'data-use-modal' => 'true']) !!}
                                            {!! Form::open(['method' => 'delete', 'route' => ['accounts.budgets.destroy', $current_account, $budget], 'class' => 'item', 'data-use-confirm' => 'true', 'data-confirm-modal-title' => 'Supprimer la transaction', 'data-confirm-modal-message' => 'Souhaitez-vous définitivement supprimer cet budget ? Les transactions associées deviendront orphelines.']) !!}
                                            <div type="submit">Supprimer</div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="header">{{$budget->title}}</div>
                                <div class="meta">{{$budget->description}} - {{$budget->transactions->count()}} transaction(s)</div>
                                <div class="description">
                                    <div class="ui blue progress" data-percent="{{$progressPourcent}}">
                                        <div class="bar"></div>
                                        <div class="label">@amount($budget->getAmountSpent()) / @amount($budget->amount)</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('accounts.transactions.create', ['accounts' => $current_account->id, 'budget' => $budget->id]) }}" class="ui bottom attached button" data-use-modal="true">
                                <i class="add icon"></i>
                                Transaction
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <a href="{{ route('accounts.budgets.create', ['accounts' => $current_account, 'month' => $month, 'year' => $year]) }}" class="ui icon mini button" data-use-modal="true">
            <i class="add icon"></i>
            Ajouter un budget
        </a>
    </div>
</div>

<script>
    $('.progress').progress({
        autoSuccess: false
    });

    $('.settings-icon').dropdown({
        action: "hide"
    });
</script>
@stop
