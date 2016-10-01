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
                                <div class="header">{{$budget->title}}</div>
                                <div class="meta">{{$budget->description}} - {{$budget->transactions->count()}} transaction(s)</div>
                                <div class="description">
                                    <div class="ui blue progress" data-percent="{{$progressPourcent}}">
                                        <div class="bar"></div>
                                        <div class="label">@amount($budget->getAmountSpent()) / @amount($budget->amount)</div>
                                    </div>
                                </div>
                            </div>
                            <div class="ui bottom attached button">
                                <i class="add icon"></i>
                                Transaction
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <a href="{{ route('accounts.budgets.create', ['accounts' => $current_account]) }}" class="ui icon mini button" data-use-lightbox="true">
                <i class="add icon"></i>
                Ajouter un budget
            </a>
        </div>
    </div>
</div>
<script>
    $('.progress').progress({
        autoSuccess: false
    });
</script>
@stop
