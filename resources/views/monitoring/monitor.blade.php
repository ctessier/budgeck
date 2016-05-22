@extends('layouts.front')

@section('title', 'Suivi mensuel')

@section('content')
    <div class="columns large-4"></div>
    <div class="columns large-8">
        <h3>{{ $month_title }}</h3>
        {!! HTML::linkRoute('accounts.budgets.create', 'Ajouter un budget', ['accounts' => $current_account->id, 'year' => $year, 'month' => $month], ['class' => 'btn-tiny radius', 'data-use-lightbox' => 'true']) !!}
        @if ($budgets->count() === 0)
            <div class="alert align-center">
                Aucun budget à afficher
            </div>
        @else
            <div class="">
                @foreach ($budgets as $budget)
                    <div class="budget">
                        {{-- Budget infos --}}
                        <span class="title">{{ $budget->title }}</span>
                        <span class="description">{{ $budget->description }}</span>
                        <span class="actions">
                            {!! HTML::linkRoute('accounts.budgets.show', 'Voir les transactions', ['accounts' => $budget->account->id, 'budgets' => $budget->id], ['class' => 'btn-tiny radius', 'data-use-lightbox' => 'true']) !!}
                            {!! HTML::linkRoute('accounts.budgets.edit', 'Modifier', ['accounts' => $budget->account->id, 'budgets' => $budget->id], ['class' => 'btn-tiny radius', 'data-use-lightbox' => 'true']) !!}
                            {!! Form::open(['method' => 'delete', 'route' => ['accounts.budgets.destroy', $budget->account->id, $budget->id], 'style' => 'display:inline;', 'data-use-confirm' => 'true', 'data-confirm-message' => 'Souhaitez-vous définitivement supprimer ce budget ?']) !!}
                            <a class="btn-tiny btn-red radius" data-form-submit="true">Supprimer</a>
                            {!! Form::close() !!}
                        </span>
                        {{-- Budget progress bar --}}
                        {{--*/ $totalAmountSpent = $budget->getAmountSpent() /*--}}
                        {{--*/ $effectiveAmountSpent = $budget->getAmountSpent(Budgeck\Models\Transaction::EFFECTIVE) /*--}}
                        <div class="progress-bar-container">
                            <div class="progress-bar awaiting {{($totalAmountSpent > $budget->amount) ? 'full' : ''}}"
                                 style="width:{{min(100, ($totalAmountSpent / $budget->amount) * 100)}}%">
                                <div class="current-amount">
                                    @amount($totalAmountSpent)
                                </div>
                            </div>
                            <div class="progress-bar {{($effectiveAmountSpent <= $budget->amount) ? 'green' : 'red'}}"
                                 style="width:{{min(100, ($effectiveAmountSpent / $budget->amount) * 100)}}%">
                                <div class="current-amount">
                                    @amount($effectiveAmountSpent)
                                </div>
                            </div>
                            <span class="amount">@amount($budget->amount)</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@stop
