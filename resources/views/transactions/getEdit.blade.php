@extends('layouts.lightbox')

@section('content')
@if ($isCreation)
{!! Form::open(['method' => 'post', 'route' => ['transactions.postSave', null], 'data-ajax-form' => 'true']) !!}
@else
{!! Form::model($transaction, ['method' => 'post', 'route' => ['transactions.postSave', $transaction->id], 'data-ajax-form' => 'true']) !!}
@endif
<div class="row">
    <div class="columns large-12">
        @if ($isCreation)
        <h3>Nouvelle transaction</h3>
        @else
        <h3>Modifier une transaction</h3>
        @endif
    </div>
</div>
<div class="row">
    <div class="columns large-12">
        <div class="form-group">
            {!! Form::label('title', 'Titre') !!}
            {!! Form::text('title', null, ['placeholder' => 'Titre...']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('budget_id', 'Budget') !!}
            {!! Form::select('budget_id', $budgets, Input::get('budget_id')) !!}
        </div>
    </div>
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('income_id', 'Revenu') !!}
            {!! Form::select('income_id', $incomes, Input::get('income_id')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('amount', 'Montant') !!}
            {!! Form::text('amount', null, ['placeholder' => 'Montant...']) !!}
        </div>
    </div>
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('transaction_date', 'Date de transaction') !!}
            {!! Form::text('transaction_date', null, ['placeholder' => 'Date de transaction...', 'class' => 'datepicker']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('category_id', 'Catégorie') !!}
            {!! Form::select('category_id', Budgeck\Category::getExpenseCategoriesList()) !!}
        </div>
    </div>
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('effective_date', 'Date effective') !!}
            {!! Form::text('effective_date', null, ['placeholder' => 'Date effective...', 'class' => 'datepicker']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-12">
        <div class="form-group">
            @if ($isCreation)
            {!! Form::submit('Créer la transaction', ['class' => 'btn-base radius']) !!}
            @else
            {!! Form::submit('Sauvegarder', ['class' => 'btn-base radius']) !!}
            @endif
            <a class="btn-base btn-grey radius" data-lightbox-dismiss="true">Annuler</a>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop